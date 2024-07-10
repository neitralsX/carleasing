<?php
session_start();
require_once "db_connect.php";

if (isset($_SESSION["username"])) {
  if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Location: profile_admin.php");
  } else {
    header("Location: profile.php");
  }
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $username = mysqli_real_escape_string($conn, $username);

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["password"];

    if (password_verify($password, $hashedPassword)) {
      $_SESSION["username"] = $username;

      $sql_admin = "SELECT * FROM admins WHERE username='$username'";
      $result_admin = $conn->query($sql_admin);
      if ($result_admin->num_rows === 1) {
        $_SESSION["admin"] = true;
        header("Location: profile_admin.php");
      } else {
        header("Location: profile.php");
      }
      exit;
    } else {
      $error = "Nepareizs lietotājvārds vai parole.";
    }
  } else {
    $error = "Nepareizs lietotājvārds vai parole.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signin</title>
  <link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
<body>
  <div class="container">
  <?php if (isset($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
        <form class="signup-form"  action="signin.php" method="POST">
            <h2>Ieiet</h2>
            <div class="input-container">
                <input type="text" name="username" placeholder="Lietotājvārds" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Parole" required>
            </div>
            <input type="submit" class="btn" value="Ieiet">
        </form>
        
        <center>
        <a href="signup.html" class="back-link">Reģistrēties</a><br>
          <a href="index.php" class="back-link">Atgriezties uz galveno lapu</a></center>
    </div>
</body>
</html>
