<?php
include 'db.php';
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['User Name'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.html");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>
