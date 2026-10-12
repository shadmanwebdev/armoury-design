<?php
    class Db {
        public $con;
        private $servername = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'armoury_design';
        
        private $servername_2 = '';
        private $username_2 = '';
        private $password_2 = '';
        private $dbname_2 = '';

        public function con() {
            $server = $_SERVER['SERVER_NAME'];
            if($server == 'localhost' || $server == 'http://___.test') {
                $con = new mysqli(
                    $this->servername, 
                    $this->username, 
                    $this->password, 
                    $this->dbname
                );
            } else if($server == 'example-hosting.42web.io') {
                $con = new mysqli(
                    $this->servername_2, 
                    $this->username_2, 
                    $this->password_2, 
                    $this->dbname_2
                );
            }
            // Check connection
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            return $con;
        }
    }
?>
