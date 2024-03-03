    <script>
        var user_id = <?= $user['id'] ?>
    </script>
    <p><b>Покупатель: </b><?= $user['lastname'] ?> <?= $user['firstname'] ?> <?= $user['middlename'] ?></p>
    <p><b>Телефон:</b> <?= $user['phone_number'] ?></p>
    <p><b>E-mail:</b> <?= $user['email'] ?></p>
    <div class="table_header">
        <div class="order_table_header ">
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
            <div class="order_description">Описание</div>
        </div>
    </div>
    <div class="table_data" id="table_data">

    </div>
    <script src="/js/request.js"></script>
    <script src="/js/user_orders.js"></script>