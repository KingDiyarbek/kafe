<?php
session_start();
require_once '../config/connect.php';
$id = $_GET['id'];
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$tovar = mysqli_query($connect, query:"SELECT menu.*, category.Name_category, img.* FROM menu INNER JOIN category ON menu.Category = category.idCategory LEFT JOIN img ON menu.Image = img.id WHERE  menu.`idMenu`= '$id'");
$tovar = mysqli_fetch_assoc($tovar);
if (!isset($_SESSION['admin'])) {
    header('Location: ../admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/update.css">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
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
    <form action="../config/update_tovar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_tovar" value="<?= $tovar['idMenu']?>">
    <input type="hidden" name="id_category" value="<?= $tovar['Category']?>">
    <input type="hidden" name="name_category" value="<?= $tovar['Name_category']?>">
    <label>Название</label>
    <input type="text" name="Name" value="<?= $tovar['Name']?>">
    <label>Цена</label>
    <input type="text" name="Price" value="<?= $tovar['Price']?>">
    <label>Описание</label>
    <textarea name="Description"><?= $tovar['Description']?></textarea>
    <input type="text" name="Weight" value="<?= $tovar['Weight']?>">
    <input type="hidden" name="idFile" value="<?= $tovar['id']?>">
    <input type="file" name="file"><img src="<?= $tovar['File']?>" alt="">
    <button class="button_update" name="submit"><span>Изменить</span></button>
</form>

    </div>

</div>
<script src="../js/swiper_menu.js"></script>
<script src="js/profile.js"></script>
</body>
</html>

