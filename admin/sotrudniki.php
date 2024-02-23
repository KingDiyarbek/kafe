<?php
session_start();
require_once '../config/connect.php';
$result_sidebar = mysqli_query($connect, query: 'SELECT * FROM `category`');
$result_pizza = mysqli_query($connect, query: "SELECT * FROM `menu`");
$result_aksii = mysqli_query($connect, query: 'SELECT * FROM `aksi`');
$result_user = mysqli_query($connect, query: 'SELECT * FROM `user`');
if (!isset($_SESSION['admin'])) {
    header('Location: ../admin.php');
}
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
    <div class="tovar">
        <div class="container_tovar">
            <div class="sotrudnik_card">
                <?php
                while ($sotrudnik = mysqli_fetch_assoc($result_user)) {
                ?>
                    <div class="card-container">
                        <img class="round" src="<?= $sotrudnik['Image'] ?>" alt="user">
                        <h2><?= $sotrudnik['Surname'] ?> <?= $sotrudnik['Name'] ?> <?= $sotrudnik['Patronymic'] ?></h2>
                        <h3><?= $sotrudnik['Post'] ?></h3>
                        <div class="login">
                            <h4>Логин:<?= $sotrudnik['login'] ?></h4>
                            <h4>Пароль:<?= $sotrudnik['password'] ?></h4>
                        </div>
                        <div class="skills">
                            <a class="primary" href="../config/delete_user.php?idUser=<?= $sotrudnik['idUser'] ?>">Удалить</a>
                            <a class="primary ghost" href="update_sotrudnik.php?idUser=<?= $sotrudnik['idUser'] ?>">Изменить</a>
                        </div>
                    </div>

                <?php
                }
                ?>
                <button class="user_create">+</button>
            </div>
        </div>

    </div>

    <div class="create_user">
        <div class="container_create_user">
            <h1>Добавление сотрудника</h1>
            <div class="content_create_user">
                <form action="../config/create_user.php" method="post" enctype="multipart/form-data">
                    <label for="Surname">Фамилия</label>
                    <input type="text" name="Surname">
                    <label for="Name">Имя</label>
                    <input type="text" name="Name">
                    <label for="Patronymic">Очество</label>
                    <input type="text" name="Patronymic">
                    <label for="Post">Должность</label>
                    <input type="text" name="Post">
                    <label for="Image">Фотография</label>
                    <input type="file" name="file">
                    <label for="login">Логин</label>
                    <input type="text" name="login">
                    <label for="password">Пароль</label>
                    <input type="text" name="password">
                    <button type="submit">Добавить</button>
                </form>
                <button class="modal__close">&#10006;</button>
            </div>
        </div>
    </div>
    <script src="../js/swiper_menu.js"></script>
    <script src="../js/sotrudniki.js"></script>
</body>
</html>