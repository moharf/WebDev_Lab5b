<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = ""; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $accessLevel = $_POST['accessLevel'];

    $sql = "INSERT INTO users (matric, name, email, password, accessLevel) 
            VALUES ('$matric', '$name', '$email', '$password', '$accessLevel')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Registration successful! <a href='login.php'>Click here to log in</a>";
    } else {
        $success_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registration Form</h2>
    <?php
    if (!empty($success_message)) {
        echo "<p style='color: green; font-weight: bold; text-align: center;'>$success_message</p>";
    }
    ?>
    <form method="POST" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required><br><br>
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Access Level:</label>
        <select name="accessLevel">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
