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
                    <a href="">
                        <i class='bx bx-briefcase-alt-2'></i>
                        <span class="link_name">Заказы</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="">Заказы</a></li>
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
                                <li><a href="">Новые</a></li>
                                <li><a href="">Прочитанные</a></li>
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
            <h2>Файл</h2>
            <img src="<?= $komentariya['File'] ?>" alt="">
            <video controls="controls" src="<?= $komentariya['File'] ?>"></video>
            <button type="submit">Прочитано</button>
        </form>
    </div>

</div>
<script src="js/profile.js"></script>
<script src="../js/swiper_menu.js"></script>
</body>
</html>