<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Project.php';
    
    if(isset($_POST['create_project'])) {
        $project = new Project();
        $project->create();
    }
    if(isset($_POST['update_project'])) {
        $project = new Project();
        $project->update($_POST['project_id']);
    }
    if(isset($_GET['del_project'])) {
        $project = new Project();
        $project->delete($_GET['del_project']);
    }
?>