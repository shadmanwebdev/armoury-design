<?php

include '../partials/functions.php';
include '../Classes/Db.php';
include '../Classes/Service.php';


if(isset($_POST['create_service'])) {
    $service = new Service();
    $service->create();
}
if(isset($_POST['update_post']) && isset($_POST['service_id'])) {
    $service = new Service();
    $service->update($_POST['service_id']);
}
if(isset($_GET['delete_service'])) {
    $service = new Service();
    $service->delete($_GET['delete_service']);
}
// if(isset($_GET['del']) && isset($_GET['pid'])) {
//     $post = new Post();
//     $post->del_thumbnail($_GET['del'], $_GET['pid']);
// }

?>