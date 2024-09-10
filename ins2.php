<?php
include_once('db2.php');

if(isset($_POST['submit'])){
    // Escape user inputs to prevent SQL injection
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Check if the email exists
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        echo "<script>alert('The email already exists')</script>";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the database
        $sql = "INSERT INTO `users` (user_firstname, user_lastname, email, password) 
                VALUES ('$first', '$last', '$email', '$hashedPassword')";

        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error in inserting the data')</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
 