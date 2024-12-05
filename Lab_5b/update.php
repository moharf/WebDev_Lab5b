<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    $sql = "UPDATE users SET matric='$matric', name='$name', accessLevel='$accessLevel' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
<a href="logout.php">Logout</a>
    <h2>Update User</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo $user['matric']; ?>" required><br><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
        <label>Access Level:</label>
        <select name="accessLevel">
            <option value="user" <?php if ($user['accessLevel'] == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if ($user['accessLevel'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
