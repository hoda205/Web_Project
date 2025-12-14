<?php 
session_start();
if(!$_SESSION['role']== 'Admin')header('Location: ../HTML/login.php');
if(!$_GET['messageId'])header('Location: ../HTML/dashboard.php');
$messageId = $_GET['messageId'];
include '../PHP/messageDetails.php';
$row = mysqli_fetch_assoc($messageDetails)
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
    <title>Message Details</title>
</head>

<body class="content">
    <main>
        <div class="page container" id="addEditProduct">
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="text-decoration-none text-black fs-1 me-3"><i class="fa-solid fa-left-long"></i></a>
                <h2 class="my-4">Order Details</h2>
            </div>
            <div class="mb-3 mx-5 gap-3 row">
                <div class="col rounded-3 bg-bage py-3 px-3 shadow">
                    <h3>Customer info</h3>
                    <p><b>Name</b>: <?php echo $row['name'] ?></p>
                    <p><b>Email</b>: <?php echo $row['email'] ?></p>
                </div>
                <div class="col  rounded-3 bg-bage py-3 px-3 shadow">
                    <h3>Subject</h3>
                    <p class="mt-3"><?php echo $row['subject'] ?></p>
                </div>
            </div>
            <div class="mb-3 mx-5 rounded-3 bg-bage py-3 px-3 shadow">
                <h3>Message</h3>
                <p><?php echo $row['message'] ?></p>
            </div>
        </div>
    </main>
</body>

</html>