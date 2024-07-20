<?php
//<?php
  //  Declare database credentials
  /*$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "crochet_shop";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  return $conn;*/

include 'db.php';
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $user = $conn->real_escape_string($_POST['User Name']);
    $email = $conn->real_escape_string($_POST['Email']);
    $pass = $conn->real_escape_string($_POST['Password']);
    $phone = $conn->real_escape_string($_POST['Phone number']);
    $terms = $conn->real_escape_string($_POST['Terms & conditions']);

    // Validate terms
    if ($terms !== 'agree') {
        echo "You must agree to the terms and conditions.";
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user, $email, $hashed_password, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the home page after successful sign-up
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>