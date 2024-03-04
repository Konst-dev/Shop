<?php

namespace app\controllers;

use app\engine\Request;
use app\models\{Users, Orders, Products, Product_order};


class ShopController extends Controller
{

    /**
     * Выдает JSON со всеми заказами
     */
    protected function actionGetOrders()
    {
        $orders = Orders::getAllJoin(Users::getTableName(), 'user_id', 'id');
        echo json_encode($orders, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }

    /**
     * Выдает Общую стоимость заказа. Вход: id методом POST
     */
    protected function actionGetOrderPrice()
    {
        $req = new Request();
        $params = $req->getParams();
        $order_id = $params['id'];
        $products = Product_order::getWhereAssocJoin(Product_order::getTableName(), 'order_id', $order_id, Products::getTableName(), 'product_id', 'id');
        $sum = 0;
        foreach ($products as $product) {
            $sum += $product['price'];
        }
        echo json_encode(['id' => 'price_' . $order_id, 'price' => $sum], JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }

    /**
     * Показывает страницу с информацией о заказе.
     */
    protected function actionOrder()
    {
        $req = new Request();
        $params = $req->getParams();
        $order_id = $params['par_4'];
        $order = Orders::getWhereAssocJoin(Orders::getTableName(), 'id', $order_id, Users::getTableName(), 'user_id', 'id');
        $products = Product_order::getWhereAssocJoin(Product_order::getTableName(), 'order_id', $order_id, Products::getTableName(), 'product_id', 'id');
        echo $this->render('order', ['order' => $order[0], 'products' => $products, 'order_id' => $order_id]);
    }

    /**
     * Показывает страницу с данными покупателя
     */
    protected function actionUser()
    {
        $req = new Request();
        $params = $req->getParams();
        $user_id = $params['par_4'];
        $user = Users::getWhereAssoc('id', $user_id);
        echo $this->render('user', ['user' => $user[0]]);
    }

    /**
     * Возвращает JSON с заказами покупателя. Вход: id методом POST
     */
    protected function actionGetUserOrders()
    {
        $req = new Request();
        $params = $req->getParams();
        $user_id = $params['id'];
        $orders = Orders::getWhereAssoc('user_id', $user_id);
        echo json_encode($orders, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }

    /**
     * Cохраняет новый заказ с формы. Возвращает JSON с обновленным списком заказов
     */
    protected function actionNewOrder()
    {
        $req = new Request();
        $pars = $req->getParams();
        $user = new Users($pars['lastname'], $pars['firstname'], $pars['middlename'], $pars['phone'], $pars['email']);
        $user->save();
        $order = new Orders(date("Y-m-d H:i:s"), false, $pars['description'], $user->id);
        $order->save();
        foreach ($pars['products'] as $product) {
            $product_order = new Product_order($product, $order->id);
            $product_order->save();
        }
        $orders = Orders::getAllJoin(Users::getTableName(), 'user_id', 'id');
        echo json_encode($orders, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }
}
