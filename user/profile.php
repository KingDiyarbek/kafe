<?php
session_start();
require_once '../config/connect.php';
$result_sidebar = mysqli_query($connect, query: 'SELECT * FROM `category`');
$result_pizza = mysqli_query($connect, query: "SELECT * FROM `menu`");
$result_aksii = mysqli_query($connect, query: 'SELECT * FROM `aksi`');

if (!isset($_SESSION['user'])) {
    header('Location: admin.php');
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
    <div class="tovar">
        <div class="container_tovar">
            <div class="aksi_card">
                <?php
                while ($aksi = mysqli_fetch_assoc($result_aksii)) {
                ?>
                    <form action="aksiya_info.php">
                        <div class="aksi_content">
                            <div class="img_card"><img src="<?= $aksi['Image'] ?>" alt="">
                            </div>
                            <div class="aksi_content_text">
                                <div class="data">
                                    <h3 class="data"><?= $aksi['Data'] ?></h3>
                                </div>
                                <div class="aksi_text">
                                    <h2><?= $aksi['Name']; ?></h2>
                                </div>

                                <div class="aksi_priwiew">
                                    <p><?= $aksi['Description']; ?></p>
                                </div>
                                </a>
                            </div>
                            <div class="aksi_btn">
                                <a href="config/delete_aksi.php?id=<?= $aksi['idAksi'] ?>"><img src="../image/profile/delete.png" alt=""></a>
                                <a class="setup_tovar" href="update_aksii.php?id=<?= $aksi['idAksi'] ?>">Изменить</a>
                            </div>

                        </div>
                    </form>

                <?php
                }
                ?>
                <button class="aksi_create">+</button>
            </div>
        </div>
    </div>

    <div class="create_aksi">
        <div class="container_create_aksi">
            <h1>Добавление акции</h1>
            <div class="content_create_aksi">
                <form action="config/create_aksi.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="Name" placeholder="Названия">
                    <input type="date" name="Date">
                    <textarea name="Description" placeholder="Названия"></textarea>
                    <input type="file" name="file">
                    <button type="submit">Добавить</button>
                </form>
                <button class="modal__close">&#10006;</button>
            </div>
        </div>
    </div>
    <script src="../js/profile.js"></script>
    <script src="../js/swiper_menu.js"></script>
</body>

</html>