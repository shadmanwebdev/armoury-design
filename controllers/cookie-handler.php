<?php
// example-hosting.42web.io
$server = $_SERVER['SERVER_NAME'];
if(isset($_POST['cookie_status'])) {
    if($_POST['cookie_status'] == 'accept_all') {
        $cookies = ['necessary' => 1, 'functional' => 1, 'analytic' => 1, 'ads' => 1];
        $cookies_string = json_encode($cookies);
        setcookie("cookies", $cookies_string,time() + (60*60*24*90),'/',$server); // Set cookie for 90 days
        echo '1';
    } 
    else if ($_POST['cookie_status'] == 'deny_all') {
        $cookies = ['necessary' => 1, 'functional' => 0, 'analytic' => 0, 'ads' => 0];
        $cookies_string = json_encode($cookies);
        setcookie("cookies", $cookies_string, time() + (60*15), '/',$server);
        echo '0';
    }
    else if ($_POST['cookie_status'] == 'custom') {
        $cookies = ['necessary' => $_POST['necessary'], 'functional' => $_POST['functional'], 'analytic' => $_POST['analytic'], 'ads' => $_POST['ads']];
        $cookies_string = json_encode($cookies);
        setcookie("cookies", $cookies_string, time() + (60*60*24*90), '/', $server);
        echo '2';
    }
}



?>