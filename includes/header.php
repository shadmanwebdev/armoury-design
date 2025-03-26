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
    $fileDir = dirname(__FILE__); 
    // $parentDir = dirname($fileDir);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);

    include(ROOT_PATH.'includes/cookies-setup.php');
    include(ROOT_PATH.'functions.php');
    include(CLASSES_PATH.'Db.php');
    include(CLASSES_PATH.'User.php');
    include(CLASSES_PATH.'SiteSettings.php');
    include(CLASSES_PATH.'Home.php');
    include(CLASSES_PATH.'AboutSection.php');
    include(CLASSES_PATH.'Faq.php');
    include(CLASSES_PATH.'Service.php');
    include(CLASSES_PATH.'Demo.php');
    include(CLASSES_PATH.'ContactInfo.php');
    include(CLASSES_PATH.'About.php');
    include(CLASSES_PATH.'Testimonial.php');
    // include(CLASSES_PATH.'Quote.php');

    $settings = new SiteSettings();
    $home = new Home();
    


    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 1; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + 1;
        $_SESSION['v'] = $v;
    }
    // $restricted = array('myaccount');
    // echo $page = get_pagename();
    // if(!isset($_SESSION['user'])) {
    //     if(in_array($page, $restricted)) {
    //         header('location: ./');
    //     }
    // }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $settings->sitename(); ?></title>
    <meta name='title' content='<?= $settings->title_tag(); ?>'>
    <meta name='description' content='<?= $settings->meta_description(); ?>'>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <link rel="stylesheet" href="./css/msg-response.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/main.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/banner-section.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/section-top.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/nav-2.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/about-2.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/about-3.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/slider.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/owl.carousel.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/owl-custom.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/testimony.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/services.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/ionicons.min.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/contact.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/404.css?v=<?=$v;?>">
    <!-- <link rel="stylesheet" href="./css/footer.css"> -->
    <link rel="stylesheet" href="./css/footer-2.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/demos.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/faq.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/get-a-quote.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/ionicons.min.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/user.css?v=<?=$v;?>">
    <link rel="stylesheet" href="./css/cookies.css?v=<?=$v;?>">
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>
    <script src="./js/login.js?v=<?= $v; ?>" defer></script>
    <script src="./js/main.js?v=<?=$v;?>" defer></script>
    <script src="./js/owl.carousel.js?v=<?=$v;?>" defer></script>
    <script src="./js/owl-custom.js?v=<?=$v;?>" defer></script>
    <script src="./js/quote.js?v=<?=$v;?>" defer></script>
    <script src="./js/contact-info.js?v=<?=$v;?>" defer></script>
    <script src="./js/nav.js?v=<?=$v;?>" defer></script>
    <script src="./js/contact.js?v=<?=$v;?>" defer></script>
    <script src="./js/popup.js?v=<?=$v;?>" defer></script>
    <script src="./js/cookies.js?v=<?=$v;?>" defer></script>
    
</head>
<body>
    
    <?php 
        if($show_consent == True) { 
    ?>
        <div class="hide_popup popup" id='cookie_consent_popup'>
            <h1>Cookies</h1>
            <label onclick='denyCookies()' for="close_cookie" id="close_cookie_box">X</label>
            <p>We use cookies to help you navigate efficiently and perform certain functions. You will find detailed information about cookies by clicking "Settings". The cookies that are categorized as "Strictly necessary" are stored on your browser as they are essential for enabling the basic functionalities of the site. We also use third-party cookies that help us analyze how you use this website, store your preferences, and provide the content and advertisements that are relevant to you. These cookies will only be stored in your browser with your prior consent. You can choose to enable or disable some or all of these cookies but disabling some of them may affect your browsing experience.<p>
            <div class='btns-grid'>
                <span id='settings-btn' class='popup-btn' onclick='openSettings()'>Settings</span>
                <span id="accept-btn" class='popup-btn' onclick='acceptCookies()'>Accept All</span>
            </div>
        </div>
        <!-- Cookie settings popup -->
        <div class='cookie-preference popup hide_popup' id='cookie-settings-popup'>
            <div class='popup-heading'>
                <h4>
                    Cookie Preferences
                </h4>
            </div>
            <div class='popup-body'>
                <form action='./cookie-handler.php' class='post'>
                    <div class='pref-group'>
                        <div class='row'>
                            <div class='selection'>
                                <label class="switch" onclick='check2(this)'> 
                                    <input type="checkbox" class="category-checkbox" checked id='necessary'> 
                                    <span class="tick"></span> 
                                    <span class="tick-bg"></span> 
                                </label>
                            </div>
                            <h4 class="category-name">Strictly necessary</h4>
                        </div>
                        <div class='preference-description'>
                        These trackers are used for activities that are strictly necessary to operate or deliver the service you requested from us and, therefore, do not require you to consent.
                        </div>
                    </div>
                    <div class='pref-group'>
                        <div class='row'>
                            <div class='selection'>
                                <label class="switch" onclick='check(this)'> 
                                    <input type="checkbox" class="category-checkbox" id='functional'> 
                                    <span class="tick"></span> 
                                    <span class="tick-bg"></span> 
                                </label>
                            </div>
                            <h4 class="category-name">Functionalities</h4>
                        </div>
                        <div class='preference-description'>
                        These trackers enable basic interactions and functionalities that allow you to access selected features of our service and facilitate your communication with us.
                        </div>
                    </div>
                    <div class='pref-group'>
                        <div class='row'>
                            <div class='selection'>
                                <label class="switch" onclick='check(this)'> 
                                    <input type="checkbox" class="category-checkbox" id='analytic''> 
                                    <span class="tick"></span> 
                                    <span class="tick-bg"></span> 
                                </label>
                            </div>
                            <h4 class="category-name">Analytics</h4>
                        </div>
                        <div class='preference-description'>
                        Analytical cookies are used to understand how visitors interact with the website. These cookies help provide information on metrics such as the number of visitors, bounce rate, traffic source, etc.
                        </div>
                    </div>
                    <div class='pref-group'>
                        <div class='row'>
                            <div class='selection'>
                                <label class="switch" onclick='check(this)'> 
                                    <input type="checkbox" class="category-checkbox" id='ads'> 
                                    <span class="tick"></span> 
                                    <span class="tick-bg"></span> 
                                </label>
                            </div>
                            <h4 class="category-name">Advertisement</h4>
                        </div>
                        <div class='preference-description'>
                        Advertisement cookies are used to provide visitors with customized advertisements based on the pages you visited previously and to analyze the effectiveness of the ad campaigns.
                        </div>
                    </div>


                    <span class='confirm' onclick='customCookies()'>Confirm</span>
                </form>
            </div>
        </div>
    <?php 
        }
    ?>
    <div id='loader'></div>
    <div id="bgOverlay"></div>
    <div id='popBg'></div>
    
    <!-- <div id="bgOverlay"></div>
    <div id='popBg'></div> -->

    <div class='main'>


    
