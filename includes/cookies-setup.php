<?php
    // json_encode($cookies) and json_decode($_COOKIE['cookies'],True)

    if(!isset($_COOKIE['cookies'])){
        // First time visitor
        // Get the user countrycode by ip
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $geo = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$ip),True);
        $country_codesEU = ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL', 'ES', 'FI', 'FR', 'GB', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'];


        if ($geo['geoplugin_countryCode'] == Null || in_array($geo['geoplugin_countryCode'],$country_codesEU)){
            // User is in the EU or we do not know where he is from.
            // Ask for cookies consent, if within 15 minutes the user comes back, they accept
            $show_consent = True;	
            $cookies = ['necessary'=> 0, 'functional' => 0, 'analytic' => 0, 'ads' => 0];
            $cookies_string = json_encode($cookies);
            setcookie("cookies",$cookies_string,time() + (60*15),'/','localhost');
        } else {
            // The user is not in the EU, so we can set cookies
            $show_consent =  True;
            $cookies = ['necessary'=> 1, 'functional' => 1, 'analytic' => 1, 'ads' => 1];
            $cookies_string = json_encode($cookies);
            setcookie("cookies",$cookies_string,time() + (60*60*24*90),'/','localhost'); // Set cookie for 90 days
        }
    } else {
        // We'll get the user preferences
        $show_consent = False; // Don't show the popup	
        $cookies = json_decode($_COOKIE['cookies'],True);

        // If consent == 'asking', the user continued on the website and has accepted
        
        $cookies = ['necessary'=> 1, 'functional' => 1, 'analytic' => 1, 'ads' => 1];
        $cookies_string = json_encode($cookies);
        setcookie("cookies",$cookies_string,time() + (60*60*24*90),'/','localhost'); // Set cookie for 90 days
        	
    }
?>