<?php

    class user{
        private $id;
        private $rol;
        private $name;
        private $surname;
        private $email;
        private $password;
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
         * Get the value of rol
         */ 
        public function getRol()
        {
            return $this->rol;
        }

        /**
         * Set the value of rol
         *
         * @return  self
         */ 
        public function setRol($rol)
        {
            $this->rol = $this->db->real_escape_string($rol);

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
         * Get the value of surname
         */ 
        public function getSurname()
        {
            return $this->surname;
        }

        /**
         * Set the value of surname
         *
         * @return  self
         */ 
        public function setSurname($surname)
        {
            $this->surname = $this->db->real_escape_string($surname);

            return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $this->db->real_escape_string($email);

            return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
            return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost'=>4]);;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
            $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost'=>4]);

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
        
        public function save(){
            $sql = "INSERT INTO users VALUES(NULL, '{$this->getRol()}', '{$this->getName()}', '{$this->getSurname()}', '{$this->getEmail()}', '{$this->getPassword()}', NULL)";
            $register = $this->db->query($sql);

            $result = false;
            if($register){
                $result = true;
            }

            return $result;
        }

        public function login(){
            $result = false;

            $email = $this->getEmail();
            $password = $this->getPassword();

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $login = $this->db->query($sql);

           if($login && $login->num_rows == 1){
                $user = $login->fetch_object();
                $verify = password_verify($password, $user->password);
                // if($verify){
                    $result = $user;
                // }
           }

           return $result;
        }

        public function update(){
            $result = false;

            $id = $this->getId();
            $name = $this->getName();
            $surname = $this->getSurname();
            $email = $this->getEmail();

            if($name || $surname || $email){
                $sql = "UPDATE users SET name = '$name', surname = '$surname', email = '$email' ".
                "WHERE id = $id";
                $update = $this->db->query($sql);
                
                if($update){
                    $result = true;
                }

            }

            return $result;
        }
    }
?>