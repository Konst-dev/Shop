<?php

namespace app\controllers;

use app\engine\Request;
use app\models\{Users, Orders, Products, Product_order};


class MainController extends Controller
{



    protected function actionIndex()
    {
        $products = Products::getAll();
        echo $this->render('orders', ['products' => $products]);
    }

    /**
     * Заполнение базы данных данными
     */
    protected function actionSeed()
    {
        $names = [
            ['id' => 0, 'lastname' => 'Иванов', 'firstname' => 'Иван', 'middlename' => 'Иванович', 'phone_number' => '+79000000000', 'email' => 'user1@mail.ru'],
            ['id' => 0, 'lastname' => 'Петров', 'firstname' => 'Петр', 'middlename' => 'Петрович', 'phone_number' => '+79000000001', 'email' => 'user2@mail.ru'],
            ['id' => 0, 'lastname' => 'Сидоров', 'firstname' => 'Сергей', 'middlename' => 'Сергеевич', 'phone_number' => '+79000000002', 'email' => 'user3@mail.ru'],
        ];

        $products = [
            ['id' => 0, 'name' => 'Телевизор', 'description' => '41 дюйм...', 'price' => 20000],
            ['id' => 0, 'name' => 'Ноутбук', 'description' => 'Core i7...', 'price' => 60000],
            ['id' => 0, 'name' => 'Фен', 'description' => '2000 Вт', 'price' => 1000],
            ['id' => 0, 'name' => 'Смартфон', 'description' => 'Samsung', 'price' => 40000],
            ['id' => 0, 'name' => 'Клавиатура', 'description' => '105 клавиш', 'price' => 1500],
            ['id' => 0, 'name' => 'Мышь', 'description' => 'Оптическая', 'price' => 600],
            ['id' => 0, 'name' => 'Наушники', 'description' => 'Беспроводные BT', 'price' => 2000],
            ['id' => 0, 'name' => 'Микроволновая печь', 'description' => '1000 Вт', 'price' => 7000],
            ['id' => 0, 'name' => 'Кофемашина', 'description' => '4 бар', 'price' => 30000],
            ['id' => 0, 'name' => 'Чайник', 'description' => 'Электрический 2200 Вт', 'price' => 1300],
        ];

        foreach ($names as $key => $name) {
            $user = new Users(
                $name['lastname'],
                $name['firstname'],
                $name['middlename'],
                $name['phone_number'],
                $name['email']
            );
            $names[$key]['id'] = $user->save()->id;
        }

        foreach ($products as $key => $prod) {
            $product = new Products(
                $prod['name'],
                $prod['description'],
                $prod['price'],
            );
            $products[$key]['id'] = $product->save()->id;
        }

        $orders = [
            ['id' => 0, 'date_time' => '2024-03-03 12:00:00', 'is_paid' => false, 'user_id' => $names[0]['id']],
            ['id' => 0, 'date_time' => '2024-02-29 13:00:00', 'is_paid' => true, 'user_id' => $names[1]['id']],
            ['id' => 0, 'date_time' => '2024-03-02 11:00:00', 'is_paid' => true, 'user_id' => $names[0]['id']],
            ['id' => 0, 'date_time' => '2024-03-03 10:00:00', 'is_paid' => false, 'user_id' => $names[1]['id']],
            ['id' => 0, 'date_time' => '2024-01-31 18:00:00', 'is_paid' => false, 'user_id' => $names[1]['id']]
        ];

        foreach ($orders as $key => $order_item) {
            $order = new Orders(
                $order_item['date_time'],
                $order_item['is_paid'],
                'Заказ товаров',
                $order_item['user_id'],
            );
            $orders[$key]['id'] = $order->save()->id;
        }

        $links = [
            ['product_id' => $products[0]['id'], 'order_id' => $orders[0]['id']],
            ['product_id' => $products[1]['id'], 'order_id' => $orders[1]['id']],
            ['product_id' => $products[2]['id'], 'order_id' => $orders[2]['id']],
            ['product_id' => $products[3]['id'], 'order_id' => $orders[3]['id']],
            ['product_id' => $products[4]['id'], 'order_id' => $orders[4]['id']],
            ['product_id' => $products[5]['id'], 'order_id' => $orders[0]['id']],
            ['product_id' => $products[6]['id'], 'order_id' => $orders[1]['id']],
            ['product_id' => $products[7]['id'], 'order_id' => $orders[2]['id']],
            ['product_id' => $products[8]['id'], 'order_id' => $orders[3]['id']],
            ['product_id' => $products[9]['id'], 'order_id' => $orders[4]['id']],
            ['product_id' => $products[9]['id'], 'order_id' => $orders[0]['id']],
            ['product_id' => $products[8]['id'], 'order_id' => $orders[1]['id']],
            ['product_id' => $products[7]['id'], 'order_id' => $orders[2]['id']],
            ['product_id' => $products[6]['id'], 'order_id' => $orders[3]['id']],
            ['product_id' => $products[5]['id'], 'order_id' => $orders[4]['id']],
            ['product_id' => $products[1]['id'], 'order_id' => $orders[4]['id']],
            ['product_id' => $products[3]['id'], 'order_id' => $orders[4]['id']],
            ['product_id' => $products[6]['id'], 'order_id' => $orders[4]['id']],
        ];

        foreach ($links as $key => $link) {
            $product_order = new Product_order(
                $link['product_id'],
                $link['order_id'],
            );
            $product_order->save();
        }


        //var_dump($names);
    }
}
