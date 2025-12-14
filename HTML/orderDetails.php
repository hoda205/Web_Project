<?php 
session_start();
if(!$_SESSION['role']== 'Admin')header('Location: ../HTML/login.php');
if(!$_GET['orderId'])header('Location: ../HTML/dashboard.php');
$orderId = $_GET['orderId'];
include '../PHP/orderDetails.php';
$order = mysqli_fetch_assoc($orderDetails)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../CSS/dashboardStyle.css">
    <title>Order Details</title>
</head>

<body class="content">
    <main>
        <div class="page container" id="addEditProduct">
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="text-decoration-none text-black fs-1 me-3"><i class="fa-solid fa-left-long"></i></a>
                <h2 class="my-4">Order Details</h2>
            </div>
            <div class=" mb-3 mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                <h3>Order Summary</h3>
                <div class="d-flex justify-content-between">
                    <div>
                        <p>Status</p>
                        <?php 
                            if($order['Status'] == 'Accepted') echo '<span class="badge bg-success">Accepted</span>';
                            else if($order['Status'] == 'Rejected') echo '<span class="badge bg-danger">Rejected</span>';
                            else echo '<span class="badge bg-warning">Pending</span>';
                        ?>
                    </div>
                    <div>
                        <p>Totel</p>
                        <!-- Total of The order  -->
                        <p class="fs-5"><b>$<?php echo $order['Total']?></b></p>
                    </div>
                </div>
            </div>
            <div class="mb-3 mx-5 gap-3 row">
                <div class="col  rounded-3 bg-bage py-3 px-3 shadow">
                    <h3>Customer info</h3>
                    <p><b>Name</b>: <?php echo $order['Name']?></p>
                    <p><b>Phone</b>: <?php echo $order['Phone_Number']?></p>
                    <p><b>Email</b>: <?php echo $order['Email']?></p>
                </div>
                <div class="col  rounded-3 bg-bage py-3 px-3 shadow">
                    <h3>Delivery Address</h3>
                    <p><b>Address</b>: <?php echo $order['Address']?></p>
                </div>
            </div>
            <div class="mb-3 mx-5 rounded-3 bg-bage py-3 px-3 shadow">
                <h3>Comment</h3>
                <p>
                <?php
                    if (!empty($order['Comment'])) {
                        echo  $order['Comment'] ;
                    }
                    else echo 'No Comment';
                    ?>
                </p>
                </div>
            <div class="mb-3  mx-5 rounded-3 bg-bage py-3 px-3 shadow">
                <h3>Order Product List</h3>
                <p <?php echo mysqli_num_rows($cart) > 0?'hidden':''; ?>>No products in this order.</p>
                <table class="table table-striped " <?php echo mysqli_num_rows($cart) > 0?'':'hidden'; ?>>
                    <thead class="bg-pink">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($cart)): ?>
                        <tr>
                            <td><? echo $i++; ?></td>
                            <td><img src="../images/<php echo $row['pImg']; ?>" width="100"></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td>$<?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                            <td>$<?php echo $row['Subtotal']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" ><b>Total</b></td>
                            <td>$<?php echo $order['Total']?></td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
    </main>
</body>
</html>