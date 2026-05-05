<?php
require 'includes/database.php';

// Ověříme, jestli už uživatel existuje
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute(['alexg07']);
if (!$stmt->fetch()) {
    // Heslo zahashujeme (kvůli bezpečnosti)
    $password = password_hash('1234', PASSWORD_DEFAULT);

    // Vložení uživatele
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute(['alexg07', $password, 'admin']);

    echo "Uživatel alexg07 byl úspěšně přidán.";
} else {
    echo "Uživatel alexg07 už existuje.";
}
?>
