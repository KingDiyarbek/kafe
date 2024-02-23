<?php
require_once 'config/connect.php';
$listCategory = mysqli_query($connect, query: 'SELECT * FROM `category`');
$categories = mysqli_fetch_all($listCategory, MYSQLI_ASSOC);
$menuItems = mysqli_query($connect, "SELECT menu.*, category.Name_category FROM menu INNER JOIN category ON menu.Category_idCategory = category.idCategory");
$menuItems = mysqli_fetch_all($menuItems, MYSQLI_ASSOC);
$menuByCategory = [];
foreach ($menuItems as $menuItem) {
    $categoryName = $menuItem['Name_category'];
    $menuByCategory[$categoryName][] = $menuItem;
}
$result_aksii = mysqli_query($connect, query:'SELECT * FROM `aksi`');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Kaushan+Script&family=Montserrat:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <!--Стили элементов для корзины-->
    <!--swiper-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <title>DiMoa</title>
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
                    <div class="corzina">
                        <img class="corzina_open" src="image/shopping-basket-wight1.svg" alt="">
                        <span class="corzina_kol">0</span>
                    </div>
				</div>
			</div>
</header>

    <div class="intro">
        <div class="intro_inner">
            <div class="container">
                <h2 class="intro_suptitle">Caf<span>e</span> Di<span>Moa</span></h2>
                <h1 class="intro_title">Добро пожаловать</h1>

            </div>
        </div>
    </div>

    <div class="zakaz">
        <div class="zakaz_window">
            <div class="zakaz_head">
                <div class="product_name">Товар</div>
                <div class="product_price">Цена</div>
                <div class="product_quality">Количество</div>
                <div class="product_itogo">Итого</div>
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
            
            <form method="post" action="config/zakaz.php" id="checkoutForm">
                <div class="checkout-form">
                    <h2>Оформление заказа</h2>
                    <input type="text" name="fullName" id="fullName" placeholder="ФИО" required>
                    <input type="text" name="address" id="address" placeholder="Адрес" required>
                    <input type="tel" name="phone" id="phone" placeholder="Телефон" required>
                    <!-- Скрытое поле для передачи общей суммы заказа -->
                    <input type="hidden" name="total" id="total" value="">
                    <button type="submit" id="submitBtn">Оформить заказ</button>
                </div>
            </form>

            <div id="orderConfirmationModal" class="Modal_thanks">
                <div class="Modal_thanks-content">
                    <h2>Заказ принят</h2>
                    <p>Спасибо за ваш заказ!</p>
                </div>
            </div>
        </div>
        <button class="corzina__close">&#10006;</button>
    </div>

    <section class="section">
        <div class="container">
            <div class="section_header">
                <h2 class="section_title">Наши Акции</h2>
            </div>
        </div>
    </section>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        <?php foreach ($result_aksii as $aksii) : ?>
            <div class="swiper-slide"><img src="<?= $aksii['Image'] ?>" alt=""></div>
        <?php endforeach; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <section class="section">
        <div class="container">
            <div class="section_header">
                <h2 class="section_subtitle">Почему выбирают</h2>
                <h2 class="section_title">наше кафе</h2>
            </div>
        </div>
    </section>

    <div class="motive">
        <div class="container">
            <div class="cols">
                <div class="col">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/pizza.jpeg)">
                            <div class="inner">
                                <p>Уютная атмосфера</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p> Dimoa предлагает уютное и стильное оформление интерьера, созданное с учетом последних тенденций в дизайне.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/burger.jpg)">
                            <div class="inner">
                                <p>Качество продуктов</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p>Dimoa гордится своим высоким качеством продуктов. </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col" ontouchstart="this.classList.toggle('hover');">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/hot_dog.jpg)">
                            <div class="inner">
                                <p> Меню разнообразие</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p>В Dimoa представлено большое разнообразие блюд и напитков.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col" ontouchstart="this.classList.toggle('hover');">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/salat.jpg)">
                            <div class="inner">
                                <p>Превосходное обслуживание</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p>Команда сотрудников Dimoa обеспечивает высококлассное обслуживание, где каждый клиент чувствует себя особенным и важным.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col" ontouchstart="this.classList.toggle('hover');">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/shaurma.jpg)">
                            <div class="inner">
                                <p>Удобное расположение</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p>Dimoa расположено в удобном месте, с хорошей транспортной доступностью. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" ontouchstart="this.classList.toggle('hover');">
                    <div class="content_wrapper">
                        <div class="front" style="background-image: url(image/motive/deserti.jpg)">
                            <div class="inner">
                                <p>INDIA</p>
                                <span>MUMBAI</span>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <p>The city is a major centre for finance, commerce, and entertainment in India and is home to the Bombay Stock Exchange.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="section_header">
                <h2 class="section_title">Доставка и оплата</h2>
            </div>
        </div>
    </section>

    <div class="dostavka">
        <div class="container">
            <div class="dostavka_content">
                <img src="image/dostavka/dostavka.jpg" alt="">
                <div class="dost">
                    <h2>Доставка и оплата</h2>
                    <ul>
                        <li>Бесплатная доставка</li>
                        <li>Время доставки от 20 мин до 80 мин</li>
                        <li>Оплата произодится после получения заказа</li>
                        <li>Спобоб оплаты:</li>
                        <ol>
                            <li>Картой</li>
                            <li>Налинной</li>
                            <li>Переводом </li>
                        </ol>
                    </ul>
                    <img src="image/dostavka/dostavka-1.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <section class="section" id="menu">
        <div class="container">
            <div class="section_header">
                <h2 class="section_suptitle">Меню</h2>

            </div>
        </div>
    </section>

    <div class="filter">
        <div class="container">
            <div class="filter_content">
                <?php foreach ($categories as $category) : ?>
                    <a class="filter_text" href="#<?= $category['idCategory'] ?>"><?= $category['Name_category'] ?> </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <div class="menu">
        <?php foreach ($categories as $category) : ?>
            <h2 class="Name_category" id="<?= $category['idCategory'] ?>"><?= $category['Name_category'] ?></h2>
            <?php if (isset($menuByCategory[$category['Name_category']])) : ?>
                <?php foreach ($menuByCategory[$category['Name_category']] as $menuItem) : ?>
                    <div class="tovar">
                        <div class="menu_card">
                            <div class="container_1">
                                <div class="wrapper">
                                    <div class="banner-image"><img src="<?= $menuItem['Image'] ?>" alt=""></div>
                                    <h3><?= $menuItem['Name'] ?></h3>
                                    <p><?= $menuItem['Description'] ?></p>
                                    <h4 class="weight"><?= $menuItem['Weight'] ?></h4>
                                </div>
                                <div class="product__quantity"></div>
                                <form class="button-wrapper" action="" method="post">
                                    <input type="hidden" value="<?= $menuItem['Price'] ?>">
                                    <h1 class="btn outline"><?= $menuItem['Price'] ?></h1>
                                    <input type="hidden" name="id" value="<?= $menuItem['idMenu'] ?>">
                                    <a class="button_shop" data-sb-id-or-vendor-code="<?= $menuItem['idMenu'] ?>"
                                    data-sb-product-name="<?= $menuItem['Name'] ?>"
                                    data-sb-product-price="<?= $menuItem['Price'] ?>"
                                    data-sb-product-quantity="1"
                                    data-sb-product-img="<?= $menuItem['Image'] ?>" type="submit">Выбрать</a>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : echo 'Товары отсутствуют' ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="cart-notification" id="cartNotification">
            Товар добавлен в корзину!
        </div>
    </div>
    
        <div class="modal_food" id="modal_tovar">
            <button class="modal__close">&#10006;</button>
        <!-- Сюда будет вставлена информация из menu_card -->
        </div>

    <div class="komentariya">
        <div class="komentariya_content">
            <img src="image/komentariya/icons.png" alt="">
            <img class="ikons_1" src="image/komentariya/icons_1.png" alt="">
        </div>
        <div class="modal modal1">
            <div class="modal__main">
                <h2 class="modal_title">Комментария</h2>
                <h3 class="modal_text">Здравствуйте. Напишите пожалуйства причину обращения и мы с вами обязательно свяжемся</h3>
                <div class="content">
                    <form action="config/koment.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" class="feedback-input" placeholder="Имя" />
                        <input type="text" name="email" class="feedback-input" placeholder="Email или телефон номер" />
                        <textarea name="komentariya" class="feedback-input" placeholder="Комментария"></textarea>
                        <input type="file" name="file" class="feedback-input">
                        <input type="submit" value="Отправить" />
                        
                    </form>
                </div>
                <button class="modal__close">&#10006;</button>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="footer_inner">
                <div class="footer_inner_content">
                    <div class="footer_mesto">
                        <img src="image/footer/map.png" alt="">
                        <h2>Местоположение</h2>
                        <h3>г.Кострома ул Ткачей 7</h3>
                    </div>

                    <div class="footer_telefon">
                        <img src="image/footer/phone.png" alt="">
                        <h2>Телефон</h2>
                        <a href="">
                            <h3>777-77-77</h3>
                        </a>
                    </div>

                    <div class="footer_email">
                        <img src="image/footer/email.png" alt="">
                        <h2>E-mail</h2>
                        <a href="">
                            <h3>Dimoa-Kostoma@gmail.com</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer_content">
                <div class="footer_content_menu">
                    <h2>Меню</h2> 
                    <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li><a href="#<?= $category['idCategory'] ?>"><?= $category['Name_category'] ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>

                <div class="footer_content_aksi">
                    <h2><a href="">Акции</a></h2>
                    <h2><a href="">Контакты</a></h2>
                    <h2><a href="">О нас</a></h2>
                    <h2><a href="">Состав и калорийность</a></h2>
                </div>


                <div class="footer_content_reklama">
                    <h3>Подпишись на нас</h3>
                    <div class="social viber">
                        <a href="#" target="_blank">
                            <svg role="img" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M444 49.9C431.3 38.2 379.9.9 265.3.4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9.6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4.7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5.9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9.1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7.5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1.8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z" />
                            </svg>
                        </a>
                    </div>
                    <div class="social vk">
                        <a href="#" target="_blank">
                            <svg role="img" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" />
                            </svg>
                        </a>
                    </div>
                    <div class="social whatsapp">
                        <a href="#" target="_blank">
                            <svg role="img" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                        </a>
                    </div>
                    <div class="social instagram">
                        <a href="#" target="_blank">
                            <svg role="img" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_end">
            <h3>&#169; Dimoa 2024</h3>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
    <script src="js/menu.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/modal_menu.js"></script>
    <!--Библиотека jQuery-->
    <!--Готовый скрипт корзины-->
    <!--Swiper-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script>

    <script src="js/cart.js"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.button_shop');
            const cartNotification = document.getElementById('cartNotification');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    // Вместо этого места, где вы добавляете товар в корзину, вы можете вставить вашу логику
                    // Здесь мы просто показываем уведомление о добавлении товара в корзину
                    cartNotification.style.display = 'block';
                    setTimeout(function() {
                        cartNotification.style.display = 'none';
                    }, 1000); // Скрыть уведомление через 2 секунды
                });
            });
        });
    </script>

<script>

    </script>
    
</body>

</html>