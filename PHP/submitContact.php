<?php  
include 'connection.php';
if (isset($_POST['submit'])) {


    $name = $_POST['user_name'];
    $email = $_POST['user_email']; 
    $subject = $_POST['user_subject'];
    $message = $_POST['user_message'];

    

    $query = "INSERT INTO messages(name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../HTML/contact.php?success=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>