<?php
include('db2.php');
$email= $_POST['email'];
$password = $_POST['pwd'];
$sql = "select * from users where email = '$email' and password = '$password'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count == 1){
    header('location:students.php');
}else{
    header('location:loginpage.php');
}