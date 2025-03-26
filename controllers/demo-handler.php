<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Demo.php';
    
    if(isset($_POST['create_demo'])) {
        $demo = new Demo();
        $demo->create();
    }
    if(isset($_POST['update_demo'])) {
        $demo = new Demo();
        $demo->update($_POST['demo_id']);
    }
    if(isset($_GET['del_demo'])) {
        $demo = new Demo();
        $demo->delete($_GET['del_demo']);
    }
    if(isset($_GET['del']) && isset($_GET['id'])) {
        $demo = new Demo();
        $demo->del_thumbnail($_GET['del'], $_GET['id']);
    }
?>