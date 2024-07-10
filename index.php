<!DOCTYPE html>
<html>
<head>
  <title>Auto-katalogs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/lizings.css">
  <link rel="stylesheet" type="text/css" href="css/bloki.css">
  <link rel="stylesheet" type="text/css" href="css/cars.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div class="white-text">
            <?php
                require_once "db_connect2.php";
                $sql = "SELECT COUNT(*) as total_users FROM users";
                $result = $conn->query($sql);
                $total_users = 0;
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $total_users = $row['total_users'];
                }
                $conn->close();
            ?>
            
        </div>
      <header>
    <nav>
    <h3>Reģistrēto lietotāju skaits: <?php echo $total_users; ?></h3>
      <ul>
        <li><a href="feedback.php">Atsauksmes</a></li>
      </ul>
    </nav>
    <a href="signin.php" class="profile-button">Log-in</a>  
  </header>
  <table>
        <tr>
            <td>
                <div id="form1">
          <h1>AUTO LĪZINGA KALKULATORS</h1>
            <div id="input-group">
                <label id="label-calc" for="car-price">Auto cena: <span id="car-price-value">27,000</span></label>
                <input type="range" id="car-price" min="5000" max="50000" step="1000" value="20,000">
            </div>
            <div id="input-group">
                <label id="label-calc" for="down-payment">Pirmā iemaksa: <span id="down-payment-value">5,500</span></label>
                <input type="range" id="down-payment" min="1000" max="10000" step="500" value="5,500">
            </div>
            <div id="input-group">
                <label id="label-calc" for="lease-term">Līzinga termiņš (mēnešos): <span id="lease-term-value">36</span></label>
                <input type="range" id="lease-term" style ="background-color:red;" min="12" max="60" step="6" value="36">
            </div>
            <div id="input-group">
                <label id="label-calc" for="interest-rate">Procentu likme (%): <span id="interest-rate-value">5.5%</span></label>
                <input type="range"  style ="background-color:red;" id="interest-rate" min="1" max="10" step="0.5" value="5.5">
            </div>
            <button id="calculate-button">Calculate</button>
                  <div id="monthly-payment" class="result"></div>
        </div>
            </td>
            <td>
                        <div id="form2">
        <form action="sendapply.php" method="post">
            <label for="subject" class="form-label">Vēlamais auto:</label>
            <input type="text" name="wantedcar" class="form-input" required>

            <label for="subject" class="form-label">Vārds, Uzvārds:</label>
            <input type="text" name="fullname" class="form-input" required>

            <label for="subject" class="form-label">E-pasts:</label>
            <input type="text" name="email" class="form-input" required>
            
            <label for="subject" class="form-label">Tel. nr.:</label>
            <input type="text" name="phonenumber" class="form-input" required>

            <input type="submit" value="Nosūtīt" class="form-submit">
        </form>
    </div>
            </td>
        </tr>
    </table>
 <h1>Pieejamie auto:</h1>
 <center>
 <div>
    <input type="text" id="searchInput" placeholder="Ievadiet marku">
    <button onclick="searchCars()" class="search-button">Meklēt</button>
    <a href="index.php" class="search-button">Atcelt</a>
    <br>
</div>
</center>
<table id="tableofcar">
<?php
  require_once "db_connect.php";

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
            <br> &nbsp <?php echo $row['brand']; ?> <?php echo $row['model']; ?><br>
            <a href="generate_pdf.php?id=<?php echo $row['id']; ?>">Apraksts</a>

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
<script>
  function searchCars() {
    var searchText = document.getElementById("searchInput").value.toLowerCase();
    var carsContainer = document.querySelector('#tableofcar');
    var cars = document.querySelectorAll('#tableofcar td');

    cars.forEach(function(car) {
      car.style.visibility = 'visible';
    });

    cars.forEach(function(car) {
      var carInfo = car.innerText.toLowerCase();
      if (carInfo.indexOf(searchText) === -1) {
        car.style.visibility = 'hidden';
      } else {
        carsContainer.insertBefore(car.parentNode, carsContainer.firstChild);
      }
    });
  }
</script>
<script src="leas.js"></script>
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
    </div>
  </footer>
</center>
</body>
</html>
