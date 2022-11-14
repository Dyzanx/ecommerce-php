<?php
    require_once 'models/User.php';
    session_start();

    class userController{
        public function index(){
            echo "User controller action index";
        }

        public function register(){
            require_once 'views/user/register.php';
        }

        public function save(){
            if(isset($_POST) && !empty($_POST)){
                $user = new user();

                $name = isset($_POST['name']) ? $_POST['name'] :null;
                $surname = isset($_POST['surname']) ? $_POST['surname'] :null;
                $email = isset($_POST['email']) ? $_POST['email'] :null;
                $password = isset($_POST['password']) ? $_POST['password'] :null;

                if($name && $surname && $email && $password){
                    $user->setRol("user");
                    $user->setName($name);
                    $user->setSurname($surname);
                    $user->setEmail($email);
                    $user->setPassword($password);

                    $save = $user->save();
                    if($save){
                        $_SESSION['register'] = "completed";
                    }else{
                        $_SESSION['register'] = "failed";
                    }
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
            
            header("Location: ".base_url."?controller=user&action=register");
        }

        function login(){
            if(isset($_POST)){
                $user = new user();
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;

                if($email && $password){
                    $user->setEmail($_POST['email']);
                    $user->setPassword($_POST['password']);
                    $user = $user->login();
                    
                    if($user){
                        $_SESSION['user'] = $user;
                    }
                }
            }else{

            }
            header("Location: ".base_url."?controller=product&action=index");
        }

        function logout(){
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                $_SESSION['user'] = null;
                unset($_SESSION['user']);
            }
            header("Location: ".base_url."?controller=product&action=index");
        }

        function edit(){
            require_once 'views/user/edit.php';
        }

        function update(){
            if(isset($_POST) && !empty($_POST)){
                $user = new user();

                $name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : false;
                $surname = isset($_POST['surname']) && !empty($_POST['name']) ? $_POST['surname'] : false;
                $email = isset($_POST['email']) && !empty($_POST['name']) ? $_POST['email'] : false;

                if($name || $surname || $email){
                    $user->setId($_SESSION['user']->id);
                    $user->setName($name);
                    $user->setSurname($surname);
                    $user->setEmail($email);
                    $update = $user->update();

                    if($update){
                        $_SESSION['update'] = "completed";
                        $_SESSION['user']->name = $name;
                        $_SESSION['user']->surname = $surname;
                        $_SESSION['user']->email = $email;
                    }else{
                        $_SESSION['update'] = "failed";
                    }
                }else{
                    $_SESSION['update'] = "failed";
                }
            }
            header("Location: ".base_url."?controller=user&action=edit");
        }

    }
    
?>