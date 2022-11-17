<?php

    class utils{
        public static function deleteSession($name){
            if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
            }

            return $name;
        }

        public static function isAdmin(){
            if($_SESSION['user']->rol != "admin"){
                header("Location: ".base_url."?controller=product&action=index");
            }else{
                return true;
            }
        }

        public static function isLogged(){
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                return true;
            }else{
                header("Location: ".base_url."?controller=product&action=index");
            }
        }

        public static function getCategories(){
            require_once 'models/Category.php';
            $category = new category();
            $categories = $category->getAll();

            return $categories;
        }

        public static function statsCarrito(){
            $stats = [
                'count' => 0,
                'price' => 0
            ];
    
            if(isset($_SESSION['cart'])){
                $stats['count'] = count($_SESSION['cart']);

                foreach($_SESSION['cart'] as $prod){
                    $stats['price'] += $prod['price']*$prod['units'];
                }
            }

            return $stats;
        }

        public static function showStatus($status){
            if($status == "confirmed"){
                return 'Pendiente';
            }else if($status == 'in preparation'){
                return 'En preparacion';
            }else if($status == 'ready'){
                return 'Preparado para enviar';
            }else if($status == 'send'){
                return 'Enviado';
            }else if($status == 'En espera...'){
                return 'En espera de pago';
            }
        }
    }
?>  