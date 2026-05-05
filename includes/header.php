<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav style="padding:10px; background:#eee; margin-bottom:60px; text-align: center;">
    <a href="index.php">Domů</a> |
    <?php if (!isset($_SESSION['user'])): ?>
        <a href="login.php">Přihlásit se</a> |
        <a href="register.php">Zaregistrovat se</a>
    <?php else: ?>
        <span>Přihlášen jako: <?= htmlspecialchars($_SESSION['user']) ?> (<?= $_SESSION['role'] ?>)</span> |
        <a href="logout.php">Odhlásit se</a>
    <?php endif; ?>
</nav>