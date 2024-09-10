<?php
include('db2.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "DELETE FROM users WHERE user_ID = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: studenttable1.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert data in the databas</title>
    <style>
       
        form{
            width: 60%;
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <form action="ins3.php"  method ="post">
        <input type="text" name = "first" placeholder ="firstname"><br><br>
        <input type="text" name = "last" placeholder ="lastname"><br><br>
        <input type="text" name = "email" placeholder ="E-mail"><br><br>
        <input type="password" name = "pwd" placeholder ="password"><br><br>
       <button type ="submit" name="submit">Signup</button>
    </form>
</body>
</html>