<?php
include('./db2.php');
if(isset($_POST['submit'])) {
    $first = mysqli_real_escape_string($conn,$_POST['first']);
    $last =mysqli_real_escape_string($conn,$_POST['last']) ;
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['pwd']);
    
    // Check if the email already exists
    $sql="SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $rows= mysqli_num_rows($result);

    if($rows > 0) {  
        echo "<script>alert('User already exists in the database.')</script>";
    } else {
        // hash the password
        $hashPasword = password_hash(password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (user_firstname, user_lastname, email, password) 
                VALUES ('$first','$last','$email','$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User inserted successfully.')</script>";
        } else {
            echo "<script>alert('Error inserting user.')</script>";
        }
    }
    mysqli_close($conn);
}
?>
