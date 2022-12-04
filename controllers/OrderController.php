<?php
require_once 'models/Order.php';
require_once 'models/User.php';

class orderController
{

    function order()
    {
        require_once 'views/order/order.php';
    }

    function add()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'] && isset($_SESSION['cart']))) {
            $country = isset($_POST['country']) ? $_POST['country'] : false;
            $location = isset($_POST['location']) ? $_POST['location'] : false;
            $adress = isset($_POST['adress']) ? $_POST['adress'] : false;

            if ($country && $location && $adress) {
                $carStats = utils::statsCarrito();
                $order = new order();

                $order->setUser_id($_SESSION['user']->id);
                $order->setCountry($country);
                $order->setLocation($location);
                $order->setAdress($adress);
                $order->setCost($carStats['price']);
                $save = $order->save();

                // save lines_orders
                $save_line = $order->save_lines_orders();

                if ($save && $save_line) {
                    $_SESSION['save-order'] = 'completed';
                    $_SESSION['cart'] = null;
                    unset($_SESSION['cart']);
                } else {
                    $_SESSION['save-order'] = 'failed';
                }
            } else {
                $_SESSION['save-order'] = 'failed';
            }
        }
        header("Location: " . base_url . "order/confirm");
    }

    function edit()
    {
        utils::isAdmin();
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $order = new order();

            $order->setId($id);
            $order = $order->getOne();
        } else {
            header("Location: " . base_url . "order/confirm");
        }

        require_once 'views/order/edit.php';
    }

    function confirm()
    {
        if (isset($_SESSION['user'])) {
            $order = new Order();
            $order->setUser_id($_SESSION['user']->id);
            $order = $order->getOneByUser();

            $order_products = new Order();
            $products = $order_products->getProductsByOrder($order->id);
        }
        require_once 'views/order/confirm.php';
    }

    function myOrders()
    {
        utils::isLogged();
        $order = new order();
        $order->setUser_id($_SESSION['user']->id);
        $orders = $order->getAllByUser();

        require_once 'views/order/myOrders.php';
    }

    function details()
    {
        utils::isLogged();
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $order = new order();
            $order->setId($_GET['id']);
            $order = $order->getOne();

            // get products
            $order_products = new Order();
            $products = $order_products->getProductsByOrder($order->id);

            require_once('views/order/details.php');
        } else {
            header("Location: " . base_url . "order/myOrders");
        }
    }

    function gestion()
    {
        utils::isAdmin();
        $gestion = true;
        $orders = new order();
        $orders = $orders->getAll();

        require_once 'views/order/myOrders.php';
    }


    function changeStatus()
    {
        utils::isAdmin();
        $gestion = true;
        if (isset($_POST['orderStatus']) && isset($_POST['orderId'])) {
            $order = new order();
            $order->setId($_POST['orderId']);
            $order->setStatus($_POST['orderStatus']);
            $order->updateStatus();

            header("Location: " . base_url . "order/details&id=" . $_POST['orderId']);
        } else {
            header("Location: " . base_url . "product/index");
        }
    }
}
