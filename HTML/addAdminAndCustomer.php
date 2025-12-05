<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/dashboardStyle.css">
    <title>Add/Edit Admins</title>
</head>

<body class="content">
    <main>
        <div class="page container">
            <h2 class="my-4">New Account</h2>
            <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                <form action="../PHP/addUser.php" method="post">
                    
                    <input type="text" name="Id" value="<?php echo isset($_GET['id'])? $_GET['id']:''; ?>" hidden readonly>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="username" class="form-label">Username</label>
                            <input name="Username" type="text" class="form-control" id="username" placeholder="Enter username" <?php echo !isset($_GET['id'])? 'required':''; ?> >
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="email" class="form-label">Email</label>
                            <input name="Email" type="email" class="form-control" id="email" placeholder="Enter email" <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="number" class="form-label">Number</label>
                            <input name="Number" type="number" class="form-control" id="number" placeholder="Enter number" <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="password" class="form-label">Password</label>
                            <input name="Password" type="password" class="form-control" id="password" placeholder="Enter password"
                                <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                    </div>
                    <div class=" mb-3">
                            <input type="radio" name="Role" id="admin" value="admin"  <?php echo !isset($_GET['id'])? 'checked':''; ?>>
                            <label  for="admin" class="form-label">Admin</label>
                        
                            <input type="radio" name="Role" id="customer" value="customer" class="ms-4">
                            <label for="customer" class="form-label">Customer</label>
                        
                    </div>
                    <?php
                    if(isset($_GET['samEmail'])){
                        if($_GET['samEmail']){
                            echo '<p class="text-danger">This Email is used befor</p>';
                        }
                    }
                    if(isset($_GET['successAdd'])){
                        if($_GET['successAdd']){
                            echo '<p class="text-success">Add Successed</p>';
                        }
                        else {
                            echo '<p class="text-danger">Add Failed</p>';
                        }
                    }
                    if(isset($_GET['successUpdate'])){
                        if($_GET['successUpdate']){
                            echo '<p class="text-success">Update Successed</p>';
                        }
                        else {
                            echo '<p class="text-danger">Update Failed</p>';
                        }
                    }
                    ?>
                <button name="save" type="submit" class="px-4 py-2 rounded bg-green text-white mb-3">Save</button>
                <a href="./dashboard.php" class="px-4 py-2 rounded bg-green text-white mb-3 text-decoration-none">Back</a>
            </form>
        </div>
        </div>
    </main>
</body>

</html>