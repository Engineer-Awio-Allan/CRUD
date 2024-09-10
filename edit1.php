<?php
if(isset($_get['id'])){
    $user_id = $_get['id'];
    $query = "SELECT * FROM `users` WHERE user_ID ='$user_id'";
    $result = mysqli_query($conn,$query);
    $user = mysqli_fetch_assoc($result);
}
if(isset($_POST['update'])){
    $user_fistname= $_POST['user_fistname'];
    $user_lastname = $_POST['user_lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "UPDATE user SET user_fistname='$user_fistname' user_lastname = '$user_lastname'
    email = '$email' password = '$password' WHERE user_ID = '$user_id'";
    if($result){
        header('location:studenttable.php');
    }else{
        header('location:edit1.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 400px;
            margin: auto;
        }

        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" value="<?php echo $user['user_firstname']; ?>" required>

        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" value="<?php echo $user['user_lastname']; ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

        <label for="password">Password</label>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" required>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
