<?php
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Post.php';
    

    if(isset($_POST['searched_for'])) {
        $post = new Post();
        $post->search_count($_POST['searched_for']);
    }
    if(isset($_POST['create_post'])) {
        $post = new Post();
        $post->create();
    }
    if(isset($_POST['update_post']) && isset($_POST['post_id'])) {
        $post = new Post();
        $post->update($_POST['post_id']);
    }
    if(isset($_POST['create_comment'])) {
        $post = new Post();
        $post->create_comment();
    }
    if(isset($_GET['delete_post'])) {
        $post = new Post();
        $post->delete($_GET['delete_post']);
    }
    if(isset($_GET['del']) && isset($_GET['pid'])) {
        $post = new Post();
        var_dump($_GET['del'], $_GET['pid']);
        $post->del_thumbnail($_GET['del'], $_GET['pid']);
    }
    if(isset($_POST['like'])) {
        $post = new Post();
        $post->like($_POST['pid']);
    }
?>