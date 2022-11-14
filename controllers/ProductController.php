<?php
    require_once 'models/Product.php';

    class productController{
        function index(){
            $products = new product();
            $products = $products->getRandom(6);
            require_once 'views/product/featured.php';
        }

        function gestion(){
            utils::isAdmin();
            $products = new product();
            $products = $products->getProducts();
            require_once 'views/product/gestion.php';
        }

        function create(){
            utils::isAdmin();
            require_once 'views/product/create.php';
        }

        function show(){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $product = new product();
                $product->setId($_GET['id']);
                $product = $product->getOne();
            }
            require_once 'views/product/show.php';
        }

        function save(){
            utils::isAdmin();
            if(isset($_POST) && !empty($_POST)){
                $product = new product();
                $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : false;
                $name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : false;
                $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : false;
                $price = isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : false;
                $stock = isset($_POST['stock']) && !empty($_POST['stock']) ? $_POST['stock'] : false;

                if($category_id && $name && $description && $price && $stock){
                    $product->setCategory_id($category_id);
                    $product->setName($name);
                    $product->setDescription($description);
                    $product->setPrice($price);
                    $product->setStock($stock);

                    if(isset($_FILES['image']) && !empty($_FILES['image'])){
                        $file = $_FILES['image'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];

                        if($mimetype == "image/png" || $mimetype == "image/jpeg" || $mimetype == "image/jpge"){
                            if(!is_dir('uploads/images')){
                                mkdir('uploads/images', 0777, true);
                            }
    
                            move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                            $product->setImage($filename);
                        }
                    }

                    $save = $product->save();
                    if($save){
                        $_SESSION['save'] = 'completed';
                    }else{
                        $_SESSION['save'] = 'failed';
                    }
                }else{
                    $_SESSION['save'] = 'failed';
                }
            }
            header("Location: ".base_url."?controller=product&action=gestion");
        }

        function edit(){
            utils::isAdmin();
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $product = new product();
                $edit = true;
                $product->setId($_GET['id']);
                $product = $product->getOne();
                require_once 'views/product/create.php';
            }else{
                header("Location: ".base_url."?controller=product&action=gestion");
            }
        }

        function delete(){
            utils::isAdmin();
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $product = new product();
                $product->setId($_GET['id']);
                $delete = $product->delete();
    
                if($delete){
                    $_SESSION['delete'] = "completed";
                }else{
                    $_SESSION['delete'] = "failed";
                }
            }else{
                $_SESSION['delete'] = "failed";
            }

            header("Location: ".base_url."?controller=product&action=gestion");
        }

        function update(){
            utils::isAdmin();
            if(isset($_POST) && !empty($_POST)){
                $product = new product();

                $id = $_GET['id'];
                $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : false;
                $name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : false;
                $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : false;
                $price = isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : false;
                $stock = isset($_POST['stock']) && !empty($_POST['stock']) ? $_POST['stock'] : false;

                if($category_id && $name && $description && $price && $stock){
                    $product->setId($id);
                    $product->setCategory_id($category_id);
                    $product->setName($name);
                    $product->setDescription($description);
                    $product->setPrice($price);
                    $product->setStock($stock);

                    if(isset($_FILES['image']) && !empty($_FILES['image'])){
                        $file = $_FILES['image'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];
                        if(isset($_POST['image']) && !empty($_POST['image'])){
                            if($mimetype == "image/png" || $mimetype == "image/jpeg" || $mimetype == "image/jpge"){
                                if(!is_dir('uploads/images')){
                                    mkdir('uploads/images', 0777, true);
                                }
        
                                move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                                $product->setImage($filename);
                            }
                        }
                    }

                    $update = $product->update();
                    if($update){
                        $_SESSION['update'] = "completed";
                    }else{
                        $_SESSION['update'] = "failed";
                    }
                }else{
                    $_SESSION['update'] = "failed";
                }
            }

            header("Location: ".base_url."?controller=product&action=gestion");
        }
    }
    
?>