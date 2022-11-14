<?php
    require_once 'models/Order.php';
    require_once 'models/User.php';

    class orderController{

        function order(){
            require_once 'views/order/order.php';
        }

        function add(){
            if(isset($_SESSION['user']) && !empty($_SESSION['user'] && isset($_SESSION['cart']))){
                $country = isset($_POST['country']) ? $_POST['country'] : false;
                $location = isset($_POST['location']) ? $_POST['location'] : false;
                $adress = isset($_POST['adress']) ? $_POST['adress'] : false;

                if($country && $location && $adress){
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

                    if($save && $save_line){
                        $_SESSION['save-order'] = 'completed';
                        $_SESSION['cart'] = null;
                        unset($_SESSION['cart']);
                    }else{
                        $_SESSION['save-order'] = 'failed';
                    }
                }else{
                    $_SESSION['save-order'] = 'failed';
                }
                
            }
            header("Location: ".base_url."?controller=order&action=confirm");
        }

        function gestion(){
            utils::isAdmin();
            $orders = new order();
            $orders = $orders->getAll();

            require_once 'views/order/gestion.php';
        }

        function edit(){
            utils::isAdmin();
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];
                $order = new order();

                $order->setId($id);
                $order = $order->getOne();
            }else{
                header("Location: ".base_url."?controller=order&action=confirm");
            }
        
            require_once 'views/order/edit.php';
        }

        function confirm(){
            require_once 'views/order/confirmed.php';
        }
        
    }
    
?>