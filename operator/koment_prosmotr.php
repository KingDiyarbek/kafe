<?php
session_start();
require_once '../config/connect.php';
$id = $_GET['id'];
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$komentariya = mysqli_query($connect, query:"SELECT * FROM `komentariya` WHERE `idKomentariya`= '$id'");
$komentariya = mysqli_fetch_assoc($komentariya);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/komentariya.css">
    <title>Document</title>
</head>
<body>
<div class="sidebar close">
            <div class="logo-details">
                <i class="bx bxl-c-plus-plus"></i>
                <span class="logo_name">Dimoa</span>
            </div>
            <ul class="nav-links">
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-briefcase-alt-2'></i>    
                            <span class="link_name">Закзы</span>
                        </a>
                        <i class="bx bxs-chevron-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Заказы</a>
                            <ul>
                                <li><a href="zakaz.php">Новые</a></li>
                                <li><a href="all_zakaz.php">Прочитанные</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-message-detail'></i>    
                            <span class="link_name">Комментарии</span>
                        </a>
                        <i class="bx bxs-chevron-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Комментарии</a>
                            <ul>
                                <li><a href="komentariya.php">Новые</a></li>
                                <li><a href="all_koment.php">Прочитанные</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="profile-details">
                        <div class="profile-content">
                            <!--<img src="image/profile.jpg" alt="profileImg">-->
                        </div>
                        <div class="name-job">
                            <div class="profile_name"><?= $_SESSION['operator']['Name'] ?> <?= $_SESSION['operator']['Surname'] ?></div>
                            <div class="job"><?= $_SESSION['operator']['Post'] ?></div>
                        </div>
                        <a href="../config/logout.php"><i class="bx bx-log-out"></i></a>
                    </div>
                </li>
            </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
        </div>
    </section>
<div class="koment">
    <div class="koment_content">
        <form action="../config/updare_koment.php" method="post">
            <input type="hidden" name="id_koment" value="<?= $komentariya['idKomentariya']?>">
            <h2>Имя</h2>
            <h3><?= $komentariya['Name'] ?></h3>
            <h2>Телефон номер или почта</h2>
            <h3><?= $komentariya['email'] ?></h3>
            <h2>Комментария</h2>
            <p><?= $komentariya['komentariya'] ?></p>
            <?php if (!empty($komentariya['File']) && pathinfo($komentariya['File'], PATHINFO_EXTENSION) == 'jpg'): ?>
        <h2>Фото</h2>
        <img src="<?= $komentariya['File'] ?>" alt="">
        <?php endif; ?>
        
        <!-- Проверяем наличие файла видео -->
        <?php if (!empty($komentariya['File']) && pathinfo($komentariya['File'], PATHINFO_EXTENSION) == 'mp4'): ?>
            <h2>Видео</h2>
            <video controls="controls" src="<?= $komentariya['File'] ?>"></video>
        <?php endif; ?>
                <button type="submit">Прочитано</button>
            </form>
    </div>

</div>
<script src="js/profile.js"></script>
<script src="../js/swiper_menu.js"></script>
</body>
</html>