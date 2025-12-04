<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flower_shopdb";
// هنا بيعمل conntection بالداتا بيز الي عملناها 
$conn = new mysqli($servername, $username, $password, $dbname);
// لو حصل خطأ في الاتصال 
if ($conn->connect_error) {
    // هتوقف تنفيذ الكود و تطبع 
    // Connection failed + رسالة الخطأ الي رجعت
    die("Connection failed: " . $conn->connect_error);
}
?>
