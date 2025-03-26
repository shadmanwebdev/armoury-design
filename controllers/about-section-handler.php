<?php

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/AboutSection.php';

    $about_section = new AboutSection();
    
    if(isset($_POST['update_about_summary'])) {
        $about_section->update();
    }
    if(isset($_GET['del'])) {
        // var_dump($_GET);
        $about_section->delete_img($_GET['del'], $_GET['type']);
    }

?>