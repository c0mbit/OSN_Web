<?php
require 'includes/database.php';
if ($_SESSION['role'] !== 'admin') {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->execute([$_POST['role'], $_POST['id']]);
}

$users = $pdo->query("SELECT * FROM users")->fetchAll();
foreach ($users as $user) {
    echo "<form method='post'>
        {$user['username']} - {$user['role']}
        <select name='role'>
            <option value='admin'" . ($user['role'] === 'admin' ? " selected" : "") . ">admin</option>
            <option value='redaktor'" . ($user['role'] === 'redaktor' ? " selected" : "") . ">redaktor</option>
        </select>
        <input type='hidden' name='id' value='{$user['id']}'>
        <button type='submit'>Změnit roli</button>
    </form>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ochrana – nikdy nedovolit změnit roli uživatele 'alexg07'
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    $targetUser = $stmt->fetch();

    if ($targetUser && $targetUser['username'] === 'alexg07') {
        echo "Nelze změnit roli výchozího administrátora.";
        exit();
    }

    $allowedRoles = ['admin', 'redaktor'];
    if (in_array($_POST['role'], $allowedRoles) && is_numeric($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$_POST['role'], $_POST['id']]);
    }
}

?>
