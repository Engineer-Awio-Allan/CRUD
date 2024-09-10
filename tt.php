<?php
include('db2.php');
if(isset($_POST['submit'])){
    $first =mysqli_real_escape_string($conn,$_POST['first']);
    $last =mysqli_real_escape_string($conn,$_POST['last']);
    $email =mysqli_real_escape_string($conn,$_POST['email']);
    $password =mysqli_real_escape_string($conn,$_POST['pwd']);
if(empty($first)||empty($last)||empty($email)||empty($password)){
    echo "all the field is required";
}else{

    $sql = "select * from `users` where email = '$email'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_num_rows($result);
   if($row > 0){
    echo "<script>alert('the email exist in the database')</script>";
    header("Location: insert.php"); // Redirect back to insert.php
            exit();
   }else{
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    //$hashPassword = password_hash($password,PASSWORD_DEFAULT);
   $sql = "INSERT INTO `users` (user_firstname,user_lastname,email,password) 
   VALUES ('$first','$last','$email','$hashPassword')";
   if(mysqli_query($conn,$sql)){
    echo "<script>alert('data inserted')</script>";
    header("Location: insert.php"); // Redirect back to insert.php
            exit();
   }else{
    echo "<script>alert('data not inserted')</script>" ;
    header("Location: insert.php"); // Redirect back to insert.php
            exit();
   }
}
}
}