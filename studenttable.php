<?php
include('db2.php');
$query = 'SELECT * FROM users';
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Student Registration Table</h2>
    <table>
        <tr>
            <th>user_ID</th>
            <th>user_firstname</th>
            <th>user_lastname</th>
            <th>email</th>
            <th>password</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['user_ID']; ?></td>
            <td><?php echo $row['user_firstname']; ?></td>
            <td><?php echo $row['user_lastname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
