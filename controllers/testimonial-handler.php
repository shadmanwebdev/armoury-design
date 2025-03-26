<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Testimonial.php';
    
    if(isset($_POST['create_testimonial'])) {
        $testimonial = new Testimonial();
        $testimonial->create();
    }
    if(isset($_POST['update_testimonial'])) {
        $testimonial = new Testimonial();
        $testimonial->update($_POST['testimonial_id']);
    }
    if(isset($_GET['del_testimonial'])) {
        $testimonial = new Testimonial();
        $testimonial->delete($_GET['del_testimonial']);
    }
    if(isset($_GET['del']) && isset($_GET['id'])) {
        var_dump($_GET['del'], $_GET['id']);
        $testimonial = new Testimonial();
        $testimonial->del_thumbnail($_GET['del'], $_GET['id']);
    }
?>