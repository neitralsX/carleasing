<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $message = $_POST["message"];
  $email = $_POST["email"];

  $sql = "INSERT INTO feedback (name, message, email) VALUES ('$name', '$message', '$email')";
  if ($conn->query($sql) === TRUE) {
    header("Location: feedback.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>