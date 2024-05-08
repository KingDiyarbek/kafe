<?php
session_start();
require_once '../config/connect.php';
$id = $_GET['id'];
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$zakaz = mysqli_query($connect, query:"SELECT * FROM `zakaz` WHERE `idZakaz`= '$id'");
$zakaz = mysqli_fetch_assoc($zakaz);
$decoded_products = json_decode($zakaz['NameProduct'], true);
// Применяем utf8_decode() к каждому элементу массива $decoded_products
?>

<!DOCTYPE html>
<html lang="ru">
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
        <form action="../config/update_zakaz.php" method="post">
            <input type="hidden" name="id_zakaz" value="<?= $zakaz['idZakaz']?>">
            <h2>Имя</h2>
            <h3><?= $zakaz['Name'] ?></h3>
            <h2>Адрес</h2>
            <h3><?= $zakaz['Adres'] ?></h3>
            <h2>Телефон номер</h2>
            <p><?= $zakaz['Phone'] ?></p>
            <h2>Заказы</h2>
            <?php foreach ($decoded_products as $product) { ?>
                <h3><?= $product ?></h3>
            <?php } ?>
            <h2>Итого</h2>
            <h3><?= $zakaz['Itogo'] ?></h3>
            <button type="submit">Прочитано</button>
        </form>
    </div>

</div>
<script src="js/profile.js"></script>
<script src="../js/swiper_menu.js"></script>
</body>
</html>