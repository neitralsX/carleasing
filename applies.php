<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["username"])) {
  header("Location: index.php");
  exit;
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM admins WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $userId = $row["id"];
  $currentUsername = $row["username"];
} else {
  header("Location: index.php");
  exit;
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/cars.css">
</head>
<body> 
<center>
  <div style="position:relative;" class="container">
    <h1>Labdien, <?php echo $currentUsername; ?> !</h1>
  <a href="logout.php" class="logout-link">Iziet</a> <br>
  <a href="profile_admin.php">Atpakaļ uz profilu</a>
</div>
</center>

<table id="tableofcar">
<?php
  require_once "db_connect.php";

  if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $delete_sql = "DELETE FROM applies WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo " ";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

  $sql = "SELECT * FROM applies";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $count = 0;

    while ($row = $result->fetch_assoc()) {
      if ($count % 3 === 0) {
        echo '<tr>';
      }
      ?>
      <td id="carlist">
        <h3>Vēlamais auto: &nbsp <?php echo $row['wantedcar']; ?></h3>
        <h3>Vārds: &nbsp <?php echo $row['fullname']; ?></h3>
        <h3>E-pasts: &nbsp <?php echo $row['email']; ?></h3>
        <h3>Tel. numurs:  &nbsp <?php echo $row['phonenumber']; ?></h3>
          <?php 
              echo '<form method="post">';
              echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
              echo '<input type="submit" value="Noņemt">';
              echo '</form>';
              ?>
      </td>
      <?php
      $count++;

      if ($count % 3 === 0) {
        echo '</tr>';
      }
    }

    if ($count % 3 !== 0) {
      echo '</tr>';
    }
  } else {
    echo "Nav pieteikumu";
  }

  $conn->close();
  ?>

</table>
</body>
</html>
