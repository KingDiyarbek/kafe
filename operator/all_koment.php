<?php
session_start();
require_once '../config/connect.php';
$result_konentariya = mysqli_query($connect, query: "SELECT * FROM `komentariya`  WHERE `Status` = 'Прочитано' ORDER BY `komentariya`.`Date` DESC");
if (!isset($_SESSION['operator'])) {
    header('Location: admin.php');
}
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
                                <li><a href="komentariya.php">Новые</a></li>
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
    <div class="komentariya">
        <div class="container_komentariya">
            <div class="content_komentariya">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Номер или почта</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <?php
                while ($koment = mysqli_fetch_assoc($result_konentariya)) {
                ?>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr>
                                <td><?= $koment['Name'] ?></td>
                                <td><?= $koment['email'] ?></td>
                                <td><?= $koment['Date'] ?></td>
                                <td><?= $koment['Status'] ?></td>
                                <td><a href="koment_prosmotr.php?id=<?= $koment['idKomentariya'] ?>">Открыть</a></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
    <script src="../js/swiper_menu.js"></script>
</body>

</html>