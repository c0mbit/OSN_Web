<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="assets/css/style2.css">
<?php
require 'includes/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    header("Location: login.php");
    exit();
}
?>
<style>
  h1{
    padding-bottom: 20px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}  
</style>
<h1>REGÍSTRACE</h1>
<form method="post">
    <input type="text" name="username" placeholder="Uživatelské jméno" required>
    <input type="password" name="password" placeholder="Heslo" required>
    <button type="submit">Registrovat</button>
</form>
