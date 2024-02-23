<?
require_once 'config/connect.php';
$listCategory = mysqli_query($connect, query: 'SELECT * FROM `category`');
$categories = mysqli_fetch_all($listCategory, MYSQLI_ASSOC);
$id_aksiya = $_GET['id'];
$aksiya_info = mysqli_query($connect, query:"SELECT * FROM `aksi` WHERE `idAksi` = '$id_aksiya'");
$aksiya_info = mysqli_fetch_assoc($aksiya_info);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/aksii.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="header">
			<div class="container">
				<div class="header__body">
                    <div class="logo"><a href="">Dimoa</a></div>

					<div class="header__burger">
						<span></span>
					</div>
					<nav class="header-menu">
						<ul class="header-menu__list">
                            <li><a href="/" class="header-menu__link">Главная</a></li>
                            <li><a href="#menu" class="header-menu__link">Меню</a>
                                <ul>
                                <?php foreach ($categories as $category) : ?>
                                    <li><a href="#<?= $category['idCategory'] ?>"><?= $category['Name_category'] ?></a></li>
                                <?php endforeach; ?>
                                </ul>
                            </li>
                            <li><a href="aksii.php" class="header-menu__link">Акции</a></li>
                            <li><a href="kontact.php" class="header-menu__link">Контакты</a></li>
                            <li><a href="" class="header-menu__link">Ещё</a>
                                <ul>
                                    <li><a href="o_nas.php">О нас</a></li>
                                    <li><a href="sostav.php">Состав и калорийность</a></li>
                                </ul>
                            </li>
						</ul>
					</nav>
                    <div class="corzina"><img class="corzina_open" src="image/shopping-basket-wight1.svg" alt=""></div>
				</div>
			</div>
</header>

<div class="zakaz">
        <div class="zakaz_window">
            <div class="zakaz_head">
                <div class="product_name">Товар</div>
                <div class="product_price">Цена</div>
                <div class="product_quality">Количество</div>
                <div class="product_itogo">Общая цена</div>
                <div class="product_delete">Удалить</div>
            </div>
            <div class="smart_basket"></div>
            
            <div class="itogo">

                <div class="cart-count-container">
                    Количество товаров в корзине: <span class="cart-count">0</span>
                </div>


                <div class="total-container" name="total"  value="0">
                            Общая сумма: <span class="total" name="total"  value="0">0</span>
                </div>

            </div>
            
            <form method="post" action="save_order.php">
                <div class="checkout-form">
                    <h2>Оформление заказа</h2>
                    <input type="text" name="fullName" placeholder="ФИО">
                    <input type="text" name="address" placeholder="Адрес">
                    <input type="text" name="phone" placeholder="Телефон">
                    <input type="hidden" name="total" class="total" value="0">
                    <!-- Скрытое поле для передачи общей суммы заказа -->
                    <button type="submit">Оформить заказ</button>
                </div>
            </form>
        </div>
    </div>

<div class="content">
    <div class="container">
        <div class="name_aksii">
            <div class="title">
                <h1><?= $aksiya_info['Name'] ?></h1>
                <a href="aksii.php" class="ago">Назад</a>
            </div>                       
        </div>
        <div class="image_aksi">
            <img src=<?= $aksiya_info['Image'] ?> alt="">
        </div>
    </div>
</div>



<div id="faq">
    <div class="container">
        <ul>
            <li>
            <input type="checkbox" checked>
            <i></i>
            <h2>Подробные условия акции</h2>
            <p><?= $aksiya_info['Description'] ?></p>
            </li>
        </ul>        
    </div>
</div>

<script src="js/cart.js"></script>
<script src="js/modal.js"></script>
</body> 
</html>