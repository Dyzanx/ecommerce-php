<?php
// session_start();
require_once 'models/Product.php';

class cartController
{
    function index()
    {
        require_once 'views/cart/index.php';
    }

    function addToCart()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header("Location: " . base_url . "product/index");
        }

        $product = new product();
        $product->setId($id);
        $product = $product->getOne();

        if (is_object($product)) {
            $counter = 0;
            foreach ($_SESSION['cart'] as $index => $cartElement) {
                if ($cartElement['product_id'] == $product->id) {
                    $_SESSION['cart'][$index]['units']++;
                    $counter++;
                }
            }

            if (!isset($counter) || $counter == 0) {
                $_SESSION['cart'][] = [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'units' => 1,
                    'product' => $product
                ];
            }
        }

        header("Location: " . base_url . "cart/index");
    }

    function deleteProduct()
    {
        if (isset($_GET['index']) && !empty($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['cart'][$index] = null;
            unset($_SESSION['cart'][$index]);
        }
        header("Location: " . base_url . "cart/index");
    }

    function up()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['units']++;
        }
        header("Location: " . base_url . "cart/index");
    }

    function down()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['units']--;

            if ($_SESSION['cart'][$index]['units'] == 0) {
                $_SESSION['cart'][$index] = null;
                unset($_SESSION['cart'][$index]);
            }
        }
        header("Location: " . base_url . "cart/index");
    }

    function deleteCart()
    {
        $_SESSION['cart'] = null;
        unset($_SESSION['cart']);
        header("Location: " . base_url . "product/index");
    }
}
