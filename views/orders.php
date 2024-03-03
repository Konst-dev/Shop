<script src="/js/request.js"></script>
<script src="/js/orders.js"></script>

<div class="main_wrapper" id='main_wrapper'>
    <h1>Заказы</h1>
    <p>Нажмите на заказ, чтобы увидеть подробности</p>
    <div class="table_header">
        <div class="order_table_header">
            <div class="order_number">
                №
            </div>
            <div class="order_date_time">
                Время заказа
            </div>
            <div class="order_price">
                Стоимость
            </div>
            <div class="order_paid">
                Оплата
            </div>
            <div class="order_fio">
                Покупатель
            </div>
            <div class="order_phone">
                Телефон
            </div>
            <div class="order_email">
                E-mail
            </div>
        </div>
    </div>
    <div class="table_data" id="table_data">

    </div>

    <h2>Добавление заказа:</h2>
    <form action="" method="POST" id="form">
        <input type="text" name="lastname" id="form_lastname" placeholder="Фамилия покупателя" class="form_input" required>
        <input type="text" name="firstname" id="form_firstname" placeholder="Имя покупателя" class="form_input" required>
        <input type="text" name="middlename" id="form_middlename" placeholder="Отчество покупателя" class="form_input">
        <input type="tel" name="phone" id="phone" placeholder="Телефон" class="form_input" reqired>
        <input type="email" name="email" id="email" placeholder="email" class="form_input" required>
        <textarea name="description" id="description" cols="30" rows="10">Описание заказа</textarea>
        <p>Выберите товары:</p>
        <select name="products[]" id="form_products" multiple class="form_select">
            <?php
            foreach ($products as $product) { ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?>, <?= $product['price'] ?></option>
            <?php } ?>
        </select>
        <input type="button" value="Добавить заказ" onClick=formClick()>
    </form>


</div>
<?php

//var_dump($orders);

// $link = mysqli_connect("localhost", "root", "", "shop_test");
// if ($link) echo "OK";
// else echo "False";
// $result = mysqli_query($link, "USE `shop_test`");
// if ($result) echo "OK";
// else echo "False";

// $result = mysqli_query($link, "CREATE TABLE shop_test.`products` (`id` int(11) not null auto_increment,
//     `name` varchar(128), 
//     `description` text(1000),
//     `price` float,
//      primary key(`id`))");

// $result = mysqli_query($link, "CREATE TABLE shop_test.`orders` (`id` int(11) not null AUTO_INCREMENT,
//     `date_time` TIMESTAMP,
//     `is_paid` BOOLEAN,
//     `user_id` INT(11),
//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
//     primary key(`id`))");

// $result = mysqli_query(
//     $link,
//     "CREATE TABLE shop_test.`product_order` (
//     `product_id` INT(11),
//     `order_id` INT(11),
//     FOREIGN KEY (product_id) REFERENCES products(id),
//     FOREIGN KEY (order_id) REFERENCES orders(id))"
// );
