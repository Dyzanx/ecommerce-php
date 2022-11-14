<?php

    class category{
        private $id;
        private $name;

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
                $this->name = $name;

                return $this;
        }


        function getAll(){
            $categories = $this->db->query("SELECT * FROM categories ORDER BY id DESC");
            return $categories;
        }

        function getOne(){
            $id = $this->getId();
            $category = $this->db->query("SELECT * FROM categories WHERE id = $id");
            return $category->fetch_object();
        }

        function save(){
            $result = false;
            $name = $this->getName();
            $sql = "INSERT INTO categories VALUES(NULL, '$name')";
            $save = $this->db->query($sql);

            return $save;
        }

        function delete(){
            $id = $this->getId();
            $sql = "DELETE FROM categories WHERE id = $id";
            $query = $this->db->query($sql);
            return $query;
        }

    }

?>