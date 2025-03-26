<?php

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/About.php';

    $about = new About();
    
    if(isset($_POST['update_about'])) {
        $about->update();
    }
    if(isset($_GET['del'])) {
        // var_dump($_GET);
        $about->delete_img($_GET['del'], $_GET['type']);
    }

?>