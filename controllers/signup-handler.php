<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    

    if(isset($_POST['create_user'])) {
        $user = new User();
        $user->create();
    }
?>