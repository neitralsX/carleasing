<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = mysqli_real_escape_string($conn, $username);
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO admins (username, password_hash) VALUES ('$username', '$hashedPassword')";
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
 
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>