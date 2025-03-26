<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Category.php';
    
    if(isset($_POST['create_cat'])) {
        $cat = new Category();
        $cat->create();
    }
    if(isset($_GET['del'])) {
        $cat = new Category();
        $cat->delete($_GET['del']);
    }
?>