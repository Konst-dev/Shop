<div class="main_wrapper">
    <h1>Заказ № <?= $order_id ?></h1>
    <p><b>Покупатель: </b><a href="/shop/user/<?= $order['user_id'] ?>"><?= $order['lastname'] ?> <?= $order['firstname'] ?> <?= $order['middlename'] ?></a></p>
    <p><b>Телефон:</b> <?= $order['phone_number'] ?></p>
    <p><b>E-mail:</b> <?= $order['email'] ?></p>
    <p><b>Описание:</b> <?= $order['description'] ?></p>
    <h2>Состав заказа: </h2>
    <div class="products_table_header">
        <div class="product_name">Название</div>
        <div class="product_description">Описание</div>
        <div class="product_price">Цена</div>
    </div>
    <?php
    $price = 0;
    foreach ($products as $product) {
        $price += $product['price']; ?>
        <div class="products_table">
            <div class="product_name"><?= $product['name'] ?></div>
            <div class="product_description"><?= $product['description'] ?></div>
            <div class="product_price"><?= $product['price'] ?></div>
        </div>
    <?php } ?>
    <h2>Общая стоимость: <?= $price ?></h2>
    <h2>Статус:
        <?php
        if ($order['is_paid']) echo "Оплачен";
        else echo "Не оплачен"
        ?>
    </h2>

</div>