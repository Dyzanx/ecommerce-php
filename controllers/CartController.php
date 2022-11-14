<?php
    session_start();
    require_once 'models/Product.php';

    class cartController{
        function index(){
            require_once 'views/cart/index.php';
        }

        function addToCart(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];       
            }else{
                header("Location: ".base_url."?controller=product&action=index");
            }

            $product = new product();
            $product->setId($id);
            $product = $product->getOne();

            if(is_object($product)){
                $counter = 0;
                foreach($_SESSION['cart'] as $index => $cartElement){
                    if($cartElement['product_id'] == $product->id){
                        $_SESSION['cart'][$index]['units']++;
                        $counter++;
                    }
                }

                if(!isset($counter) || $counter == 0){
                    $_SESSION['cart'][] = [
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'units' => 1,
                        'product' => $product
                    ];
                }
            }

            header("Location: ".base_url."?controller=cart&action=index");
        }

        function removeFromCart(){
            
        }

        function deleteCart(){
            $_SESSION['cart'] = null;
            unset($_SESSION['cart']);
            header("Location: ".base_url."?controller=product&action=index");
        }
    }
    
?>