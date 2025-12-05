<?php
include '../PHP/select.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/dashboardStyle.css">
    <title>Dashboard</title>
</head>

<body>
    <main>
        <div class="row">
            <!-- Sidebar Start -->
            <aside class="sidebar col-2 bg-bage">
                <h1 class="mb-5">Fleurina</h1>
                <ul>
                    <li onclick="showPage('productsManagement')" class="menu-item ">Products Management</li>
                    <li onclick="showPage('ordersManagement')" class="menu-item">ordersManagement</li>
                    <li onclick="showPage('orderDetails')" class="menu-item">orderDetails</li>
                    <li onclick="showPage('message')" class="menu-item ">Messages</li>
                    <li onclick="showPage('adminsAccounts')" class="menu-item ">Admins Account</li>
                    <li onclick="showPage('customers')" class="menu-item active">Customers Account</li>
                </ul>
            </aside>    
            <!-- Sidebar End -->
            <!-- Content Area Start  -->
            <div class="content col-10">
                <!-- Products Management Start -->
                <div class="page display-none" id="productsManagement">
                    <h2 class="my-4 ">Product Management</h2>
                    <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow ">
                        <div class="d-flex  justify-content-end align-items-center">
                            
                            <a class="px-3 py-2 rounded bg-green text-white mb-3 text-decoration-none" href="./addAndEditeProducts.php">New Item</a>
                        </div>
                        <table class="table table-striped rounded">
                            <thead class="rounded">
                                <tr class="bg-pink">
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($products)):
                                ?>
                                <tr>
                                    <td><?php echo $row['P_Id']; ?></td>
                                    <td><img src="../images/<?php echo $row['pImg']; ?>" width="100px"></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Price']; ?>$</td>
                                    <td>
                                        <a href="./addAndEditeProducts.php?id=<?php echo $row['P_Id']; ?>" class="text-black"><i class="fa-solid fa-pen-to-square "></i></a>
                                        <a href="../PHP/delete.php?id=<?php echo $row['P_Id']?>&table=products&page=dashboard.php"  class="ms-2 text-black"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php  endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Products Management End -->
                <!-- Order Management Start -->
                <div class="page display-none" id="ordersManagement">
                    <h2 class="my-4">Order Management</h2>
                    <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                        <table class="table table-striped">
                            <thead class="bg-pink">
                                <tr>
                                    <th>Order Id</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1</td>
                                    <td>Huda</td>
                                    <td>+20108706761</td>
                                    <td>Accept</td>
                                    <td>500$</td>
                                    <td>Add Delete</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Order Management End -->
                <!-- Order Details Start  -->
                <div class="page display-none" id="orderDetails">orderDetails Page Content</div>
                <!-- Order Details End  -->
                <!-- Message Start  -->
                <div class="page " id="message">
                    <h2 class="my-4">Message</h2>
                    <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                        <table class="table table-striped">
                            <thead class="bg-pink">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row = mysqli_fetch_assoc($messages)):
                                ?>
                                <tr >
                                    <td><?php echo $row['Id'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>
                                    <td>
                                        <div ><?php echo $row['Content'] ?></div>
                                    </td>
                                    <td >
                                        <a href="../PHP/delete.php?id=<?php echo $row['Id']?>&table=messages&page=dashboard.php"  class="ms-2 text-black"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                    </tr>
                                    <?php  endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Message End  -->
                <!-- Admins Start -->
                <div class="page display-none" id="adminsAccounts">
                    <h2 class="my-4">Admins Accounts</h2>
                    <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                        <div class="d-flex  justify-content-end align-items-center">
                            <a class="px-3 py-2 rounded bg-green text-white mb-3 text-decoration-none" href="./addAdminAndCustomer.php">New Account</a>
                        </div>
                        <table class="table table-striped">
                            <thead class="bg-pink">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($admins)):
                                ?>
                                <tr>
                                    <td><?php echo $row['User_id']; ?></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td>
                                        <a href="./addAdminAndCustomer.php?id=<?php echo $row['User_id']; ?>" class="text-black"><i class="fa-solid fa-pen-to-square "></i></a>
                                        <a href="../PHP/delete.php?id=<?php echo $row['User_id']?>&table=users&page=dashboard.php"  class="ms-2 text-black"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php  endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Admins End -->
                <!-- Customers Start -->
                <div class="page display-none" id="customers">
                    <h2 class="my-4">Customers Account</h2>
                    <div class="mx-5 m-auto rounded-3 bg-bage py-3 px-3 shadow">
                        <div class="d-flex  justify-content-end align-items-center">
                            <a class="px-3 py-2 rounded bg-green text-white mb-3 text-decoration-none" href="./addAdminAndCustomer.php">New Account</a>
                        </div>
                        <table class="table table-striped">
                            <thead class="bg-pink">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($customers)):
                                ?>
                                <tr>
                                    <td><?php echo $row['User_id']; ?></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td>
                                        <a href="./addAdminAndCustomer.php?id=<?php echo $row['User_id']; ?>" class="text-black"><i class="fa-solid fa-pen-to-square "></i></a>
                                        <a href="../PHP/delete.php?id=<?php echo $row['User_id']?>&table=users&page=dashboard.php"  class="ms-2 text-black"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php  endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Customers End -->
            </div>
            <!-- Content Area End  -->
        </div>
    </main>
    <script src="../JS/script.js"></script>
</body>

</html>