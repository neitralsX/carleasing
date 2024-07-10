<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $brand = $_POST["brand"];
  $model = $_POST["model"];
  $year = $_POST["year"];
  $fueltype = $_POST["fueltype"];
  $engine = $_POST["engine"];
  $gearbox = $_POST["gearbox"];
  $cartype = $_POST["cartype"];
  $photo = $_POST["photo"];

  $brand = mysqli_real_escape_string($conn, $brand);
  $model = mysqli_real_escape_string($conn, $model);
  $year = mysqli_real_escape_string($conn, $year);
  $fueltype = mysqli_real_escape_string($conn, $fueltype);
  $engine = mysqli_real_escape_string($conn, $engine);
  $gearbox = mysqli_real_escape_string($conn, $gearbox);
  $cartype = mysqli_real_escape_string($conn, $cartype);
  $photo = mysqli_real_escape_string($conn, $photo);

  $sql = "INSERT INTO cars (brand, model, year, fueltype, engine, gearbox, cartype, photo) VALUES ('$brand', '$model', '$year', '$fueltype', '$engine', '$gearbox', '$cartype', '$photo')";
  if ($conn->query($sql) === TRUE) {
    header("Location: profile_admin.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>