<?php
require_once "db_connect.php";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo '<div class="user-block">';
  echo '<h3>' . $row["username"] . '</h3>';
  echo '</div>';
}
?>
