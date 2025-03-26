<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Quote.php';
    
    if(isset($_POST['create_quote'])) {
        // var_dump($_POST);
        $quote = new Quote();
        $quote->create();
    }
?>