<?php  
 if (isset($_POST['submit'])) {
   $name = $_POST['user_name'];
   $email = $_POST['user_email']; 
   $subject = $_POST['user_subject'];
   $message = $_POST['user_message'];

   $conn =mysqli_connect("localhost","root","","flower_shopdb");
    if(!$conn){
         echo mysqli_connect_error();
    }
    $query = "INSERT INTO messages(name, email, subject, message) VALUES ('$name','$email','$subject','$message')";
    if(!mysqli_query($conn,$query)){
        echo mysqli_error($conn);
    } else {
       echo "Message saved successfully!";
    }

  
 }
?>