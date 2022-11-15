<?php

    class order{
        private $id;
        private $user_id;
        private $country;
        private $location;
        private $adress;
        private $cost;
        private $status;
        private $date;
        private $time;

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
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
                $this->user_id = $this->db->real_escape_string($user_id);

                return $this;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                $this->country = $this->db->real_escape_string($country);

                return $this;
        }

        /**
         * Get the value of location
         */ 
        public function getLocation()
        {
                return $this->location;
        }

        /**
         * Set the value of location
         *
         * @return  self
         */ 
        public function setLocation($location)
        {
                $this->location = $this->db->real_escape_string($location);

                return $this;
        }

        /**
         * Get the value of adress
         */ 
        public function getAdress()
        {
                return $this->adress;
        }

        /**
         * Set the value of adress
         *
         * @return  self
         */ 
        public function setAdress($adress)
        {
                $this->adress = $this->db->real_escape_string($adress);

                return $this;
        }

        /**
         * Get the value of cost
         */ 
        public function getCost()
        {
                return $this->cost;
        }

        /**
         * Set the value of cost
         *
         * @return  self
         */ 
        public function setCost($cost)
        {
                $this->cost = $this->db->real_escape_string($cost);

                return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $this->db->real_escape_string($status);

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $this->db->real_escape_string($date);

                return $this;
        }

        /**
         * Get the value of time
         */ 
        public function getTime()
        {
                return $this->time;
        }

        /**
         * Set the value of time
         *
         * @return  self
         */ 
        public function setTime($time)
        {
                $this->time = $this->db->real_escape_string($time);

                return $this;
        }

        function save(){
            $user_id = $this->getUser_id();
            $country = $this->getCountry();
            $location = $this->getLocation();
            $adress = $this->getAdress();
            $cost = $this->getCost();

            $sql = "INSERT INTO orders VALUES(NULL, $user_id, '$country', '$location', '$adress', $cost, 'En espera...', CURDATE(), CURTIME())";
            $save = $this->db->query($sql);

            return $save;
        }

        function getAll(){
            $sql = "SELECT * FROM orders ORDER BY id DESC";
            $orders = $this->db->query($sql);

            return $orders;
        }

        function getOne(){
            $id = $this->getId();
            $sql = "SELECT * FROM orders WHERE id = $id";
            $order = $this->db->query($sql);

            return $order->fetch_object();
        }

        function getOneByUser(){
            $id = $this->getUser_id();
            $sql = "SELECT o.id, o.cost FROM orders o ".
                    "WHERE o.user_id = $id ORDER BY id DESC LIMIT 1";
            $order = $this->db->query($sql);
    
            return $order->fetch_object();
        }

        function getProductsByOrder($id){
        //     $sql = "SELECT * FROM products WHERE id IN ".
        //         "(SELECT product_id FROM lines_orders WHERE order_id = $id)";
        
            $sql = "SELECT pr.*, lo.units FROM products pr ".
                "iNNER JOIN lines_orders lo ON pr.id = lo.product_id ".
                "WHERE order_id = $id";

            $products = $this->db->query($sql);
    
            return $products;
        }

        function save_lines_orders(){
            $result = false;
            $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
            $query = $this->db->query($sql);
            $order_id = $query->fetch_object()->pedido;
            
            foreach($_SESSION['cart'] as $index => $element){
                $product = $element['product'];

                $insert = "INSERT INTO lines_orders VALUES(NULL, $order_id, $product->id, {$element['units']})";
                $save = $this->db->query($insert);
            }

            return $save;
        }

        function confirm(){
            require_once 'views/order/confirmed.php';
        }

        function getAllByUser(){
            $id = $this->getUser_id();
            $sql = "SELECT o.* FROM orders o ".
                "WHERE o.user_id = $id ORDER BY id DESC";
            $order = $this->db->query($sql);
            return $order;
        }
    }
?>