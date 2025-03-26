<?php

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Home.php';

    $home = new Home();

    // var_dump($_POST);
    
    if(isset($_POST['update_top_section'])) {
        $home->update();
    }
    if(isset($_GET['del'])) {
        // var_dump($_GET);
        $home->delete_img($_GET['del'], $_GET['type']);
    }

?>