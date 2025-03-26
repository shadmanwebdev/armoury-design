<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Faq.php';
    
    if(isset($_POST['create_faq'])) {
        $faq = new Faq();
        $faq->create();
    }
    if(isset($_POST['update_faq'])) {
        $faq = new Faq();
        $faq->update($_POST['faq_id']);
    }
    if(isset($_GET['del_faq'])) {
        $faq = new Faq();
        $faq->delete($_GET['del_faq']);
    }
?>