<?php
$brandId = $_POST['brandId'];

if ($_FILES['photo']['brand']) {

  $targetDir = "photos/";
  $fileName = basename($_FILES['photo']['brand']);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    echo "Upload error: " . $_FILES['photo']['error'];
    exit;
}

  $allowedTypes = array('jpg', 'jpeg', 'png');
  if (in_array($fileType, $allowedTypes)) {
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
      require_once "db_connect.php";
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "UPDATE cars SET photo = '$fileName' WHERE id = $brandId";
      if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
      } else {
        echo "Error updating picture: " . $conn->error;
      }

      $conn->close();
    } else {
      echo "Error uploading file";
    }
  } else {
    echo "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
  }
} else {
  echo "No file selected";
}
?>
