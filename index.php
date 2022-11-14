<?php 
    session_start();
    require_once 'autoload.php';
    require_once 'config/db.php';
    require_once 'helpers/Utils.php';
    require_once 'config/parameters.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/sidebar.php';

    function show_error(){
        $err = new errorController();
        $err->index();
    }

    if(isset($_GET['controller'])){
        $controller_name = $_GET['controller'].'Controller';
    }else if(!isset($_GET['controller'])){

    }else{
        show_error();
        exit();
    }

    if(class_exists($controller_name)){
        $controller = new $controller_name;

        if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
            $action = $_GET['action'];
            $controller->$action();
        }else{
            show_error();
        }
    }else{
        show_error();
    }

    require_once 'views/layout/footer.php';
?>