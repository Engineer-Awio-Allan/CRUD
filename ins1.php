<?php
include_once('db2.php');

if(isset($_POST['submit'])){
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Prepare a statement to check if the email exists
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $stmt->bind_param("s", $email); // "s" indicates the type is string
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->num_rows;

    if($rows > 0){
        echo "<script>alert('The email already exists')</script>";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare a statement to insert the data
        $stmt = $conn->prepare("INSERT INTO `users` (user_firstname, user_lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first, $last, $email, $hashedPassword);

        if($stmt->execute()){
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error in inserting the data')</script>";
        }
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the database connection
}
?>
 