<?php

    class product{
        private $id;
        private $category_id;
        private $name;
        private $description;
        private $price;
        private $stock;
        private $offer;
        private $image;
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $this->db->real_escape_string($id);

                return $this;
        }

        /**
         * Get the value of category_id
         */ 
        public function getCategory_id()
        {
                return $this->category_id;
        }

        /**
         * Set the value of category_id
         *
         * @return  self
         */ 
        public function setCategory_id($category_id)
        {
                $this->category_id = $this->db->real_escape_string($category_id);

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $this->db->real_escape_string($name);

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $this->db->real_escape_string($description);

                return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $this->db->real_escape_string($price);

                return $this;
        }

        /**
         * Get the value of stock
         */ 
        public function getStock()
        {
                return $this->stock;
        }

        /**
         * Set the value of stock
         *
         * @return  self
         */ 
        public function setStock($stock)
        {
                $this->stock = $this->db->real_escape_string($stock);

                return $this;
        }

        /**
         * Get the value of offer
         */ 
        public function getOffer()
        {
                return $this->offer;
        }

        /**
         * Set the value of offer
         *
         * @return  self
         */ 
        public function setOffer($offer)
        {
                $this->offer = $this->db->real_escape_string($offer);

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $this->db->real_escape_string($image);

                return $this;
        }

        function getProducts(){
            $products = $this->db->query("SELECT * FROM products ORDER BY id DESC");
            return $products;
        }

        function getRandom($limit){
                $products = $this->db->query("SELECT * FROM products WHERE stock > 0 ORDER BY RAND() LIMIT $limit");
                return $products;
            }

        function getOne(){
            $id = $this->getId();
            $sql = "SELECT * FROM products WHERE id = $id";
            $product = $this->db->query($sql);
            return $product->fetch_object();
        }

        function save(){
            $category_id = $this->getCategory_id();
            $name = $this->getName();
            $description = $this->getDescription();
            $price = $this->getPrice();
            $stock = $this->getStock();
            $image = $this->getImage();

            $sql = "INSERT INTO products VALUES(NULL, $category_id, '$name', '$description', $price, $stock, NULL, '$image', CURDATE())";
            $save = $this->db->query($sql);

            return $save;
        }

        function delete(){
            $id = $this->getId();
            $sql = "DELETE FROM products WHERE id = $id";
            $delete = $this->db->query($sql);

            $result = false;
            if($delete){
                $result = true;
            }
            return $result;
        }

        function update(){
            $id = $this->getId();
            $category_id = $this->getCategory_id();
            $name = $this->getName();
            $description = $this->getDescription();
            $price = $this->getPrice();
            $stock = $this->getStock();
            $image = $this->getImage();

            $sql = "UPDATE products SET category_id = $category_id, name = '$name', description = '$description', "
                    ."price = $price, stock = $stock";
            if(isset($image) && !empty($image)){
                $sql .= ", image = '$image'";
            }
            $sql .= " WHERE id = $id";

            $update = $this->db->query($sql);

            return $update;
        }

        function getByCategory(){
            $id = $this->getCategory_id();
            $sql = "SELECT p.*, c.name AS 'category_name' FROM products p ".
            "INNER JOIN categories c ON c.id = p.category_id ".
            "WHERE p.category_id = $id ORDER BY id DESC";
            $products = $this->db->query($sql);
            return $products;
        }
    }
?>