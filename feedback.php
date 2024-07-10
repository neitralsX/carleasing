<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/feedback1.css">
<title>Feedback Page</title>
</head>
<body>
    <header>
        <a href="index.php" class="profile-button">Uz galveno lapu</a>
      </header>
    
<main>
<section>
    <h1>Jūsu atsauksme</h1>
    <form id="feedbackForm" method="post">
    <label for="name">Vārds:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">E-pasts:</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Teksts:</label>
    <textarea id="message" name="message" rows="4" required></textarea>
    <input type="submit" value="Nosūtīt">
    <div id="thank-you" style="display: none;">Paldies par Jūsu atsauksmi!</div>
    </form>
</section>
</main>
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
<script>
document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('sendfeedback.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("thank-you").style.display = "block";
        setTimeout(function() {
            window.location.href = "feedback.php";
        }, 2000);
    })
    .catch(error => console.error('Error:', error));
});
</script>
</body>
</html>