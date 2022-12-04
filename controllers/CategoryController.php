<?php
require_once 'models/Category.php';
require_once 'models/Product.php';

class categoryController
{
    function index()
    {
        utils::isAdmin();
        $category = new category();
        $categories = $category->getAll();

        require_once 'views/category/index.php';
    }

    function show()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $category = new category();
            $category->setId($id);
            $category = $category->getOne();

            $product = new product();
            $product->setCategory_id($category->id);
            $products = $product->getByCategory();
        }
        require_once 'views/category/show.php';
    }

    function create()
    {
        utils::isAdmin();
        require_once 'views/category/create.php';
    }

    function save()
    {
        utils::isAdmin();
        if (isset($_POST) && !empty($_POST)) {
            $category = new category();
            $name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : false;

            if ($name) {
                $category->setName($name);
                $save = $category->save();

                if ($save) {
                    $_SESSION['save'] = "completed";
                } else {
                    $_SESSION['save'] = "failed";
                }
            } else {
                $_SESSION['save'] = "failed";
            }
        }
        header("Location: " . base_url . "category/index");
    }

    public function delete()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $category = new category();
            $category->setId($_GET['id']);
            $delete = $category->delete();

            if ($delete) {
                $_SESSION['delete'] = "completed";
            } else {
                $_SESSION['delete'] = "failed";
            }
        } else {
            $_SESSION['delete'] = "failed";
        }
        header("Location: " . base_url . "category/index");
    }
}
