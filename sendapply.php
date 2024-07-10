<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $wantedcar = $_POST["wantedcar"];
  $fullname = $_POST["fullname"];
  $email = $_POST["email"];
  $phonenumber = $_POST["phonenumber"];

  $wantedcar = mysqli_real_escape_string($conn, $wantedcar);
  $fullname = mysqli_real_escape_string($conn, $fullname);
  $email = mysqli_real_escape_string($conn, $email);
  $phonenumber = mysqli_real_escape_string($conn, $phonenumber);

  $sql = "INSERT INTO applies (wantedcar, fullname, email, phonenumber) VALUES ('$wantedcar', '$fullname', '$email', '$phonenumber')";
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>