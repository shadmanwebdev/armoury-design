<?php
    class Db {
        public $con;
        private $servername = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'armoury_design';
        
        private $servername_2 = 'sql100.epizy.com';
        private $username_2 = 'epiz_31998373';
        private $password_2 = 'yztyRSek70EPg';
        private $dbname_2 = 'epiz_31998373_armoury_design';
        
        private $servername_3 = 'sql206.epizy.com';
        private $username_3 = 'epiz_30688339';
        private $password_3 = 'VXI5Plbkl3K1cmq';
        private $dbname_3 = 'epiz_30688339_armoury_design';
        
        private $servername_4 = 'sql206.epizy.com';
        private $username_4 = 'epiz_32098721';
        private $password_4 = 'JwIvEcXvhtedp';
        private $dbname_4 = 'epiz_32098721_armoury_design';

        public function con() {
            $server = $_SERVER['SERVER_NAME'];
            if($server == 'localhost' || $server == 'http://___.test') {
                $con = new mysqli(
                    $this->servername, 
                    $this->username, 
                    $this->password, 
                    $this->dbname
                );
            } else if($server == 'testserver4.ga') {
                $con = new mysqli(
                    $this->servername_2, 
                    $this->username_2, 
                    $this->password_2, 
                    $this->dbname_2
                );
            } else if($server == 'testserver3.ga') {
                $con = new mysqli(
                    $this->servername_3, 
                    $this->username_3, 
                    $this->password_3,
                    $this->dbname_3
                );
            } else if($server == 'example-hosting.42web.io') {
                $con = new mysqli(
                    $this->servername_4, 
                    $this->username_4, 
                    $this->password_4, 
                    $this->dbname_4
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