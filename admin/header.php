<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    /*
        1. Get functions.php
        2. Connect to database
        3. Set version for css and js
    */
    $fileDir = dirname(__FILE__); // $parentDir = dirname($fileDir);
    
    // define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    define('ADMIN_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    define('INC_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR);

    // var_dump(CLASSES_PATH, ADMIN_PATH, INC_PATH)

    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 1; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + .1;
        $_SESSION['v'] = $v;
    }


    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php'; 
    include '../Classes/SiteSettings.php';
    include '../Classes/Home.php';
    include('../Classes/AboutSection.php');
    include '../Classes/Faq.php';
    include '../Classes/Service.php';
    include '../Classes/Demo.php';
    include '../Classes/ContactInfo.php';
    include '../Classes/About.php';
    include '../Classes/Testimonial.php';
    include '../Classes/Quote.php';
    include '../Classes/Project.php';
    include '../Classes/Contact.php';

    $settings = new SiteSettings();
    $home = new Home();
    $faq = new Faq();
    $user = new User();
    $user->check_user_session();
    // var_dump($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title><?= $settings->sitename(); ?></title>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->


    <!-- CSS -->
    <link rel="stylesheet" href="./css/app.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/admin.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/datepicker.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/pfp.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/contacts.css?v=<?=$v;?>">
    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <!-- JQUERY UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- JS -->
    <script src="./js/admin.js?v=<?= $v; ?>" defer></script>
    <script src="./js/faq.js?v=<?= $v; ?>" defer></script>
    <script src="./js/home.js?v=<?= $v; ?>" defer></script>
    <script src="./js/demo.js?v=<?= $v; ?>" defer></script>
    <script src="./js/contact-info.js?v=<?= $v; ?>" defer></script>
    <script src="./js/testimonial.js?v=<?= $v; ?>" defer></script>
    <script src="./js/quote.js?v=<?= $v; ?>" defer></script>
    <script src="./js/site_settings.js?v=<?= $v; ?>" defer></script>
    <script src="./js/user.js?v=<?= $v; ?>" defer></script>
    <script src="./js/project.js?v=<?= $v; ?>" defer></script>
    <script src="./js/about_section.js?v=<?= $v; ?>" defer></script>
    <script src="./js/pfp.js?v=<?= $v; ?>" defer></script>
</head>
<body>

    <div id="popBg"></div>
    <div id="bgOverlay"></div>

    <div id='msg-alert'></div>
