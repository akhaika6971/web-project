<?php
  //  Declare database credentials
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "crochet_shop";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
else{
  echo "Connected successfully";
}
  return $conn;

?>

