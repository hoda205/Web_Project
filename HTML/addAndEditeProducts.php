<?php
session_start();
if(!$_SESSION['role']== 'Admin')header('Location: ../HTML/login.php');
include '../PHP/connection.php';
$descValue = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE P_Id = '$id'";
    $desc = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($desc);
    $descValue = $row['Describtion'];
}
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
    <title>Add/Edit Products</title>
</head>

<body class="content">
    <main>
        <div class="page container" id="addEditProduct">
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="text-decoration-none text-black fs-1 me-3"><i class="fa-solid fa-left-long"></i></a>
                <h2 class="my-4">Add /Edit Product</h2>
            </div>
            <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                <form action="../PHP/addProduct.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="Id" value="<?php echo isset($_GET['id'])? $_GET['id']:''; ?>" readonly hidden>
                    <div class="row mb-3">
                        <div class=" col">
                            <label for="pName" class="form-label">Name</label>
                            <input name="pName" type="text" class="form-control" id="pName" <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col">
                            <label for="pDisc" class="form-label">Discription</label>
                            <textarea name="pDisc" id="pDisc" class="form-control" <?php echo !isset($_GET['id'])? 'required':''; ?> 
                                ><?php echo $descValue;?></textarea>
                        </div>+
                    </div>
                    <div class="row mb-3">
                        <div class=" col-3">
                            <label for="pPrice" class="form-label">Price</label>
                            <input name="pPrice" type="number" class="form-control" id="pPrice" <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col-4">
                            <label for="pImg" class="form-label">Image Of Product</label>
                            <input name="pImg" type="file" class="form-control" id="pImg" <?php echo !isset($_GET['id'])? 'required':''; ?>>
                        </div>
                    </div>
                    <?php
                    if(isset($_GET['nameImg'])){
                        echo '<p class="text-danger">This Name Of Image Is Used Befor</p>';
                    }
                    if(isset($_GET['nameProduct'])){
                        echo '<p class="text-danger">This Name Of Product Is Used Befor</p>';
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
                    <button name="save" type="submit" class="px-4 py-1 rounded bg-green text-white mb-3">Save</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>