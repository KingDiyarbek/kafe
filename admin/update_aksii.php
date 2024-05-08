<?php
session_start();
require_once '../config/connect.php';
$id = $_GET['id'];
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$aksiya = mysqli_query($connect, query:"SELECT aksii.*, img.* FROM aksii INNER JOIN img ON aksii.Image = img.id WHERE `idAksiya`= '$id'");
$aksiya = mysqli_fetch_assoc($aksiya);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/update.css">
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
                <a href="sotrudniki.php"><i class='bx bxs-user'></i><span class="link_name">Сотрудники</span></a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="sotrudniki.php">Сотрудники</a></li>
                </ul>
            </li>
            <li>
                <a href="profile.php">
                <i class='bx bxs-offer'></i>
                    <span class="link_name">Акции</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="profile.php">Акции</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bxs-pizza'></i>
                        <span class="link_name">Товары</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Товары</a></li>
                    <?php
                    while ($sidebar = mysqli_fetch_assoc($result_sidebar)) {
                    ?>
                    <li><a href="tovar.php?id=<?= $sidebar['idCategory'] ?>"><?= $sidebar['Name_category']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a href="category.php">
                    <i class='bx bxs-category'></i>
                    <span class="link_name">Категории</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="category.php">Категории</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <!--<img src="image/profile.jpg" alt="profileImg">-->
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?= $_SESSION['admin']['Name'] ?> <?= $_SESSION['admin']['Surname'] ?></div>
                        <div class="job"><?= $_SESSION['admin'] ['Post'] ?></div>
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
<div class="update">
    <div class="update_content">
        <form action="../config/update_aksi.php" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="id_aksiya" value="<?= $aksiya['idAksiya']?>">
            <label for="Name">Название</label>
            <input type="text" name="Name" value="<?= $aksiya['Name']?>">
            <label for="Date" >Дата</label>
            <input type="date" name="Data" value="<?= $aksiya['Date']?>">
            <label for="Description">Описание</label>
            <textarea name="Description"><?= $aksiya['Description']?></textarea>
            <input type="text" name="idFile" value="<?= $aksiya['id']?>">
            <input type="file" name="file"><img src="<?= $aksiya['File']?>" alt="">
            <button class="button_update"><span>Изменить</span></button>
        </form>
    </div>
</div>
<script src="../js/swiper_menu.js"></script>
</body>
</html>