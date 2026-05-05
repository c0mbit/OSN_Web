<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="assets/css/style2.css">
<?php
require 'includes/database.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['content'], $_SESSION['user_id']]);
    header("Location: dashboard.php");
    exit();
}
?>
<form method="post">
    <input type="text" name="title" placeholder="Nadpis" required><br>
    <textarea name="content" placeholder="Obsah" required></textarea><br>
    <button type="submit">Přidat</button>
</form>
