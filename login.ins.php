<?php
include_once('db2.php');
$email = $_POST['email'];
$password = $_POST['pwd'];
$sql = "select*from users where email = '$email' and password = '$password'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count ==1){
    echo "<script>alert('YOU HAVE SUCCESSFULLY LOGED IN')</script>";
    header("Location:students.php");
    exit();
    }
    else{
        echo "<script>alert('OOPS LOGIN FAILD YOUR PASSWORD OR EMAIL MIGHT BE WRONG TRY AGAIN')</script>";
        header("Location:loginpage.php");
        exit();
    }
?>