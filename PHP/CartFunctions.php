<?php
include 'connection.php';

// Ensure DB errors are logged for debugging
function db_error_log($conn) {
    error_log('MySQL Error: ' . mysqli_error($conn));
}

// Get or create pending order for a user
function getOrCreatePendingOrder($user_id) {
    global $conn;

    $sql = "SELECT O_Id FROM `order` WHERE User_Id = '$user_id' AND Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        db_error_log($conn);
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['O_Id'];
    }

    // No pending order — create one
    $sql = "INSERT INTO `order` (Total, User_id, Status) VALUES (0, '$user_id', 'Pending')";
    if (!mysqli_query($conn, $sql)) {
        db_error_log($conn);
        return false;
    }
    return mysqli_insert_id($conn);
}

// Add to cart
function addToCart($user_id, $product_id, $quantity = 1) {
    global $conn;

    $order_id = getOrCreatePendingOrder($user_id);
    if (!$order_id) return ['success' => false, 'message' => 'Failed to create order'];

    // Check if product already in cart
    $sql = "SELECT C_Id, Quantity FROM carts WHERE P_Id = '$product_id' AND O_Id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['Quantity'] + $quantity;
        $cart_id = $row['C_Id'];

        $sql = "UPDATE carts SET Quantity = '$new_quantity' WHERE C_Id = '$cart_id'";
        if (!mysqli_query($conn, $sql)) {
            db_error_log($conn);
            return false;
        }
    } else {
        // Insert new cart item
        $sql = "INSERT INTO carts (P_Id, O_Id, Quantity) VALUES ('$product_id', '$order_id', '$quantity')";
        if (!mysqli_query($conn, $sql)) {
            db_error_log($conn);
            return false;
        }
    }

    updateOrderTotal($order_id);
    return true;
}

// Update order total
function updateOrderTotal($order_id) {
    global $conn;

    $sql = "SELECT p.Price, c.Quantity
            FROM carts c
            JOIN products p ON c.P_Id = p.P_Id
            WHERE c.O_Id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        db_error_log($conn);
        return 0;
    }

    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total += ($row['Price'] * $row['Quantity']);
    }

    $sql = "UPDATE `order` SET Total = '$total' WHERE O_Id = '$order_id'";
    if (!mysqli_query($conn, $sql)) {
        db_error_log($conn);
    }

    return $total;
}

// Get cart items for a user
function getCartItems($user_id) {
    global $conn;

    $sql = "SELECT O_Id FROM `order` WHERE User_id = '$user_id' AND Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        return [
            'items' => [],
            'subtotal' => 0,
            'item_count' => 0
        ];
    }

    $row = mysqli_fetch_assoc($result);
    $order_id = $row['O_Id'];

    $sql = "SELECT
                c.C_Id,
                c.P_Id,
                c.Quantity,
                p.Name,
                p.Price,
                p.pImg,
                (p.Price * c.Quantity) as item_total
            FROM carts c
            JOIN products p ON c.P_Id = p.P_Id
            WHERE c.O_Id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        db_error_log($conn);
        return [
            'items' => [],
            'subtotal' => 0,
            'item_count' => 0
        ];
    }

    $items = [];
    $subtotal = 0;
    while ($r = mysqli_fetch_assoc($result)) {
        $items[] = $r;
        $subtotal += $r['item_total'];
    }

    return [
        'order_id' => $order_id,
        'items' => $items,
        'subtotal' => $subtotal,
        'item_count' => count($items)
    ];
}

// Update cart quantity
function updateCartQuantity($cart_id, $new_quantity, $user_id) {
    global $conn;

    $sql = "SELECT c.O_Id
            FROM carts c
            JOIN `order` o ON c.O_Id = o.O_Id
            WHERE c.C_Id = '$cart_id' AND o.User_id = '$user_id' AND o.Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        return "product doesn't exist in your cart";
    }

    $row = mysqli_fetch_assoc($result);
    $order_id = $row['O_Id'];

    $sql = "UPDATE carts SET Quantity = '$new_quantity' WHERE C_Id = '$cart_id'";
    if (!mysqli_query($conn, $sql)) {
        db_error_log($conn);
        return "failed";
    }

    updateOrderTotal($order_id);
    return "Success";
}

// Remove from cart
function removeFromCart($cart_id, $user_id) {
    global $conn;

    $sql = "SELECT c.O_Id
            FROM carts c
            JOIN `order` o ON c.O_Id = o.O_Id
            WHERE c.C_Id = '$cart_id' AND o.User_id = '$user_id' AND o.Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        return "product doesn't exist in your cart";
    }

    $row = mysqli_fetch_assoc($result);
    $order_id = $row['O_Id'];

    $sql = "DELETE FROM carts WHERE C_Id = '$cart_id'";
    if (!mysqli_query($conn, $sql)) {
        db_error_log($conn);
        return "failed";
    }

    // Check if cart is empty and remove order or update total
    $sql = "SELECT COUNT(*) as count FROM carts WHERE O_Id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $r = mysqli_fetch_assoc($result);
        if ($r['count'] == 0) {
            $sql = "DELETE FROM `order` WHERE O_Id = '$order_id'";
            mysqli_query($conn, $sql);
        } else {
            updateOrderTotal($order_id);
        }
    }

    return "Success";
}

// Get cart count
function getCartCount($user_id) {
    global $conn;

    $sql = "SELECT O_Id FROM `order` WHERE User_id = '$user_id' AND Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) return 0;

    $row = mysqli_fetch_assoc($result);
    $order_id = $row['O_Id'];

    $sql = "SELECT COUNT(*) as count FROM carts WHERE O_Id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) return 0;
    $r = mysqli_fetch_assoc($result);
    return (int)$r['count'];
}

// Get cart total amount
function getCartTotal($user_id) {
    global $conn;

    $sql = "SELECT Total FROM `order` WHERE User_id = '$user_id' AND Status = 'Pending'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) return 0;
    $row = mysqli_fetch_assoc($result);
    return $row['Total'];
}
?>