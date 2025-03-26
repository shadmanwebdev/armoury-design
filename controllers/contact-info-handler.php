<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/ContactInfo.php';

    if(isset($_POST['update_contact_info'])) {
        $coninfo = new ContactInfo();
        $coninfo->update();
    }
?>