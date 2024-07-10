<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["username"])) {
  header("Location: index.php");
  exit;
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM users WHERE username='$username'";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/cars.css">
    <link rel="stylesheet" type="text/css" href="css/bloki.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title>Profils</title>
<html>
<header>
        <a href="logout.php" class="profile-button">Iziet</a><br>
        <a href="applies.php" style="background-color: orange;" class="profile-button">Pieteikumi</a>
        <a href="user_feedbacks.php" style="background-color: orange;" class="profile-button">Lietotāju atsauksmes</a>
      </header>
<body> 
  <div style="position:relative;" class="container">
<center>
    <h1>Labdien, <?php echo $currentUsername; ?> !</h1>
    <div id="form3">
   <h1>Pievienot auto:</h1>
   <form action="addcar_admin.php" method="POST">
   <select id="brandSelect" name="brand" required onchange="toggleOtherBrand()">
   <option value="BMW">Audi</option>
  <option value="Toyota">Toyota</option>
  <option value="Mercedes-Benz">Mercedes-Benz</option>
  <option value="Mercedes-Benz">BMW</option>
  <option value="Cits"></option>
</select>
<input type="text" id="otherBrandInput" name="otherBrand" style="display: none;" placeholder="Ievadiet marku"><br>
<input type="text" name="engine" placeholder="Dzineja tilpums" required maxlength="4">
</select><br>
  <input type="text" name="model" placeholder="Modelis" required><br>
  <input type="int" name="year" placeholder="Izlaiduma gads" required maxlength="4"><br>
  <input type="text" name="cartype" placeholder="Auto tips" required><br>
  <select name="fueltype" required>
  <option value="Benzins">Benzins</option>
  <option value="Dizelis">Dizelis</option>
</select><br>
  <select name="gearbox" required>
  <option value="Manuala">Manuala</option>
  <option value="Automatiska">Automatiska</option>
</select><br>
  <form action="carphoto.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="brandId" value="<?php echo $brandId; ?>">
      <input type="file" name="photo">
      <input type="submit" value="Pievienot">
    </form>
</form></center>
</div>
</div>

<script>
function toggleOtherBrand() {
  var brandSelect = document.getElementById("brandSelect");
  var otherBrandInput = document.getElementById("otherBrandInput");

  if (brandSelect.value === "Cits") {
    otherBrandInput.style.display = "inline-block";
    otherBrandInput.required = true;
  } else {
    otherBrandInput.style.display = "none";
    otherBrandInput.required = false;
  }
}
</script>

<table id="tableofcar">
<?php
  require_once "db_connect.php";


  if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $delete_sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo " ";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

  $sql = "SELECT * FROM cars";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $count = 0;

    while ($row = $result->fetch_assoc()) {
      if ($count % 3 === 0) {
        echo '<tr>';
      }
      ?>
      <td id="carlist" style="background-color: #000; border-radius: 15px; padding: 10px; color: #fff;">
          <?php if ($row['photo']) { ?>
            <img style="position:relative; width: 400px; height: 200px;  border-radius: 10px;" src="photos/<?php echo $row['photo']; ?>" alt="photo">
          <?php } ?>
          <p>
          <img src="https://lizingsauto.lv/wp-content/themes/blank/img/icons/year.png"> &nbsp<?php echo $row['year']; ?>g.
            <img src="https://lizingsauto.lv/wp-content/themes/blank/img/icons/volume.png"> &nbsp <?php echo $row['engine']; ?> <br>
            <img src="https://lizingsauto.lv/wp-content/themes/blank/img/icons/fuel.png">&nbsp <?php echo $row['fueltype']; ?>
            <img src="https://lizingsauto.lv/wp-content/themes/blank/img/icons/gearbox.png"> &nbsp <?php echo $row['gearbox']; ?>
            <img src="https://lizingsauto.lv/wp-content/themes/blank/img/icons/hood.png"> &nbsp <?php echo $row['cartype']; ?>
            <br> &nbsp <?php echo $row['brand']; ?> <?php echo $row['model']; ?>
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
    echo "Nav automobīļu";
  }

  $conn->close();
  ?>

</table>
<center>
<footer>
  <div class="footer-container">
      <div class="footer-column">
        <h3>Kontakti</h3>
        <ul>
          <li>girt.pulle@gmail.com</li>
          <li>+37120336009 </li>
        </ul>
      </div>
          </footer>
</center>
</body>
</html>