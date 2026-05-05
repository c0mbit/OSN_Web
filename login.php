<link rel="stylesheet" href="assets/css/style2.css">
<?php include 'includes/header.php'; ?>
<?php
ob_start();
require 'includes/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Neplatné přihlašovací údaje.";
    }
}
?>
<style>
  h1{
    padding-bottom: 20px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}  
</style>
<h1>PŘÍHLÁŠENÍ</h1>
<form method="post">
    <input type="text" name="username" placeholder="Uživatelské jméno" required>
    <input type="password" name="password" placeholder="Heslo" required>
    <button type="submit">Přihlásit</button>
</form>
