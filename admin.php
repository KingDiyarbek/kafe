<?php
    session_start();
    require_once 'config/connect.php';
    if (isset($_SESSION['user'])) {
        header('Location: user/profile.php');
    }
    if (isset($_SESSION['admin'])) {
        header('Location: admin/profile.php');
    }

    if (isset($_SESSION['operator'])) {
        header('Location: operator/komentariya.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="brand-logo"></div>
    <div class="brand-title">DIMOA</div>
    <form action="config/admin_config.php" method="post">
        <input type="text" name="login" placeholder="Логин">
        <input type="password" name="password" placeholder="Введите проль" >
        <button type="submit">ВХОД</button>
    </form>

    <?php if(isset($_SESSION['message'])): ?>
        <div class="error-message"><?php echo $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</div>
</body>
</html>