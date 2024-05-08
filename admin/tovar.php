<?
require_once '../config/connect.php';
session_start();
$id_tovar = $_GET['id'];
$result_sidebar = mysqli_query($connect, query:'SELECT * FROM `category`');
$category = mysqli_query($connect, "SELECT * FROM `category` WHERE `idCategory` = '$id_tovar'");
$categor = mysqli_fetch_assoc($category);


$create_tovar = mysqli_query($connect, "SELECT menu.*, img.File FROM menu INNER JOIN img ON menu.Image = img.id WHERE menu.Category = '$id_tovar'");
if (!isset($_SESSION['admin'])) {
    header('Location: ../admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
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
<div class="tovar">
    <div class="container_tovar">
        <div class="menu">
            <?php
                while ($tovar = mysqli_fetch_assoc($create_tovar))
                {
                    ?>
                    <div class="menu_card">
                        <div class="container_1">
                            <div class="wrapper">
                                <div class="banner-image"><img src="<?= $tovar['File'] ?>" alt=""></div>
                                <h3><?= $tovar['Name']; ?></h3>
                                <p><?= $tovar['Description']; ?></p>
                            </div>

                            <form class="button-wrapper">
                                <a href="../config/delete_tovar.php?id=<?= $tovar['idMenu'] ?>"><img class="delete" src="../image/profile/delete.png" alt=""></a>
                                <a class="setup_tovar" href="update_tovar.php?id=<?= $tovar['idMenu'] ?>">Изменить</a>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            ?>
                    <button class="tovar_create">+</button>
        </div>
    </div>
    
</div>

<div class="create_tovar">
    <div class="container_create_tovar">
        <h1>Добавление товара</h1>
        <div class="content_create_tovar"> 
            <form action="../config/create_tovar.php" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="id_category" value="<?= $id_tovar ?>">
                <input type="hidden" name="name_category" value="<?= htmlspecialchars($categor['Name_category']) ?>">
                <input type="text" name="Name" placeholder="Названия">
                <input type="text" name="Price" placeholder="Цена">
                <textarea  name="Description" placeholder="Описание"></textarea>
                <textarea  name="Sostav" placeholder="Состав"></textarea>
                <input type="text" name="Weight" placeholder="Вес">
                <input type="file" name="file">
                <button type="submit">Добавить</button>
            </form>
            <button class="modal__close">&#10006;</button>
        </div>
        </div>
</div>
<script src="../js/swiper_menu.js"></script>
<script src="../js/tovar.js"></script>
</body>
</html>
