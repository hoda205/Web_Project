<?php
// اتصال قاعدة البيانات مع المنفذ 3307
session_start(); // إذا كنت تستخدم الجلسات

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'flower_shopdb';
$port = 3307;

// محاولة الاتصال
$conn = mysqli_connect($host, $user, $pass, $db, $port);

// إذا فشل الاتصال، جرب 127.0.0.1
if (!$conn) {
    $host = '127.0.0.1';
    $conn = mysqli_connect($host, $user, $pass, $db, $port);
}

// إذا ما زال فشل، جرب الاتصال بدون قاعدة بيانات أولاً
if (!$conn) {
    $conn = mysqli_connect($host, $user, $pass, '', $port);
    if ($conn) {
        mysqli_select_db($conn, $db);
    }
}

// إذا فشل كل شيء
if (!$conn) {
    die("
        <div style='padding:20px; background:#ffe6e6; border:2px solid red; border-radius:10px;'>
            <h3>❌ خطأ في الاتصال بقاعدة البيانات</h3>
            <p><strong>التفاصيل:</strong></p>
            <ul>
                <li>الخادم: $host</li>
                <li>المنفذ: $port</li>
                <li>المستخدم: $user</li>
                <li>قاعدة البيانات: $db</li>
            </ul>
            <p>تفاصيل الخطأ: " . mysqli_connect_error() . "</p>
            <p><strong>الحلول المقترحة:</strong></p>
            <ol>
                <li>تأكد من تشغيل MySQL في XAMPP</li>
                <li>تحقق من أن المنفذ 3307 هو الصحيح</li>
                <li>جرب إعادة تشغيل XAMPP</li>
            </ol>
        </div>
    ");
}

// تعيين الترميز
mysqli_set_charset($conn, "utf8mb4");

// رسالة نجاح (أزل هذه السطور في الإنتاج)
error_log("✅ تم الاتصال بنجاح بـ $db على المنفذ $port");
?>