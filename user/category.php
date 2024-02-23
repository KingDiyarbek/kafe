<?php
session_start();
require_once '../config/connect.php';
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$result_category = mysqli_query($connect, query:'SELECT * FROM `category`');
if (!isset($_SESSION['user'])) {
    header('Location: ../admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin_categoty.css">
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
                    <i class='bx bxs-offer'></i>
                    <span class="link_name">Акции</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="">Акции</a></li>
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
                        <div class="profile_name"><?= $_SESSION['user']['Name'] ?> <?= $_SESSION['user']['Surname'] ?></div>
                        <div class="job"><?= $_SESSION['user']['Post'] ?></div>
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
    <?php
                while ($category = mysqli_fetch_assoc($result_category))
                {
                    ?>
                    <div class="category">
                        <h3><?= $category['Name_category'] ?></h3>
                        <a href="update_category.php?id=<?= $category['idCategory'] ?>">Изменить</a>
                        <a href="../config/delete_category.php?id=<?= $category['idCategory'] ?>">Удалить</a>
                    </div>
                
                    <?php
                }
            ?>
    </div>
    <button class="create_category">Добавит</button>
</div>
<div class="create">
    <div class="container_create">
        <h1>Добавление категории</h1>
        <form action="config/create_category.php" method="post">
            <input type="text" name="Name" placeholder="Названия">
            <button type="submit">Добавить</button>
        </form>
        <button class="modal__close">&#10006;</button>
    </div>
</div>
<script src="../js/swiper_menu.js"></script>
<script src="../js/profile.js"></script>
</body>
</html>