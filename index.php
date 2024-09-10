<?php
session_start();
// Database connection
$host = 'localhost'; // Change if necessary
$db = 'student_management';
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $stmt = $conn->prepare("INSERT INTO students (name, email, age) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $age);
    $stmt->execute();
    $stmt->close();
}
// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, age=? WHERE id=?");
    $stmt->bind_param("ssii", $name, $email, $age, $id);
    $stmt->execute();
    $stmt->close();
}
// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
// Read (Retrieve all students)
$result = $conn->query("SELECT * FROM students");
$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Management</title>
</head>
<body>
    <div class="container">
        <h1>Student Management</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo isset($student) ? $student['id'] : ''; ?>">
            <input type="text" name="name" placeholder="Name" required value="<?php echo isset($student) ? htmlspecialchars($student['name']) : ''; ?>">
            <input type="email" name="email" placeholder="Email" required value="<?php echo isset($student) ? htmlspecialchars($student['email']) : ''; ?>">
            <input type="number" name="age" placeholder="Age" required value="<?php echo isset($student) ? htmlspecialchars($student['age']) : ''; ?>">
            <button type="submit" name="<?php echo isset($student) ? 'update_student' : 'add_student'; ?>">
                <?php echo isset($student) ? 'Update Student' : 'Add Student'; ?>
            </button>
        </form>
        <h2>Student List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['name']); ?></td>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td><?php echo htmlspecialchars($student['age']); ?></td>
                <td>
                    <a href="?edit=<?php echo $student['id']; ?>">Edit</a>
                    <a href="?delete=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
