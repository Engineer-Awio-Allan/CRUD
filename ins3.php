<?php
include('./db2.php');

if(isset($_POST['submit'])) {
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Check if any of the fields are empty
    if(empty($first) || empty($last) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required')</script>";
    } else {
        // Validate the password
        if(strlen($password) > 6) {
            echo "<script>alert('Password must be a maximum of 6 characters')</script>";
        } elseif(!preg_match('/[A-Z]/', $password)) {
            echo "<script>alert('Password must contain at least one uppercase letter')</script>";
        } elseif(!preg_match('/[a-z]/', $password)) {
            echo "<script>alert('Password must contain at least one lowercase letter')</script>";
        } elseif(!preg_match('/[\W_]/', $password)) {
            echo "<script>alert('Password must contain at least one special character')</script>";
        } else {
            // Check if the email already exists
            $sql = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);

            if($rows > 0) {  
                echo "<script>alert('User already exists in the database.')</script>";
            } else {
                // Hash the password
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (user_firstname, user_lastname, email, password) 
                        VALUES ('$first','$last','$email','$hashPassword')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('User inserted successfully.')</script>";
                    header('location:insert.php');
                    exit();
                } else {
                    echo "<script>alert('Error inserting user.')</script>";
                }
            }
        }
    }
    mysqli_close($conn);
}
?>
