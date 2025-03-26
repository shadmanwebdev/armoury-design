<?php
    /*
        add_img()
        get_uid()
        get_user_status()
        get_browser_name()
        days_ago()
        get_client_ip()
        empty_folder()
        get_server_data()
        sendEmailSwiftMailer()
        banner_section()
        get_footer_logo()
    */
    function banner_section($obj) {
        $url = $obj['url'];
        $url_text = $obj['url_text'];
        $title = $obj['title'];
        echo "<section class='banner_area'>
            <div class='banner_inner d-flex align-items-center'>
                <div class='container'>
                    <div class='banner_content text-center'>
                        <div class='page_link'>
                            <a href='./'>Home</a>
                            <i class='ion-arrow-right-b'></i>
                            <a href='$url'>$url_text</a>
                        </div>
                        <h2>$title</h2>
                    </div>
                </div>
            </div>
        </section>";
    }
    function add_img($n) {
        // $img = $_FILES['image']['name'];
        // if($n == '') {
            $img = $_FILES[$n]['name'];
        // } else {
        //     $img = $_FILES['image'.$n]['name'];
        // }
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../img/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                // if($n == '') {
                    $tempname = $_FILES[$n]['tmp_name'];
                // } else {
                //     $tempname = $_FILES['image'.$n]['tmp_name'];
                // }
                
                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    function get_uid() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        }
    } 
    function get_user_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        }
    }
    function get_browser_name($user_agent) {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
        return 'Other';
    }
    function days_ago($n) {
        $date = new DateTime("now", new DateTimeZone('Europe/Dublin') );
        $date = $date->modify('-'.$n.' day');
        $daysAgo = $date->format('Y-m-d');
        return $daysAgo;
    }
    function send_this_mail($email, $url) {
        $to = $email;
        $from = 'testemail6329@gmail.com';
        
        $message = "<p>Your password reset link: </p>$url";
    
        $headers = "From: $from";
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
        $subject = 'OkTnx Password Reset';

    
        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
        $body .= $message;
        $body .= "</body></html>";
    
        $send = mail($to, $subject, $body, $headers);
    }
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }  
    function empty_folder() {
        $files = glob('./assets/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                unlink($file); // delete file
            }
        }
    }
    function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
        return false;
    }
    function loggedin_dropdown() {
        echo "<div id='logged-in'>
            <div id='dropdown-trigger'>
                <div class='profile-icon'>
                    <img src='./img/svg/user-128.svg' class='filter-wh'>
                </div>
                <div>Alex</div>
            </div>
            <ul id='logged-in-dropdown' class='hidden'>
                <li><a href='./myaccount'>My Account</a></li>
                <li><a href='./signout-handler?signout=true'>Sign out</a></li>
            </ul>
        </div>";
    }
    function get_footer_logo() {
        return "<div class='logo footer-logo'>                
            <div class='logo-text'>
                <a href='./'>
                    Armoury Design
                </a>
            </div>
        </div>";
    }
    function nav_logo_2() {
        return "<div class='logo nav-logo' id='desktop-logo'>                
            <div class='logo-text'>
                <a href='./' id='nav-logo'>
                    FindNow
                </a>
            </div>
        </div>";
    }
    function nav_logo() {
        return "<div class='logo nav-logo' id='desktop-logo'>      
            <a href='./'>
                <img src='./img/DESKTOP_LOGO_OKTNX_WEB.png' alt=''>
            </a>
        </div>";
    }
    function nav_logo_mobile() {
        return "<div class='logo nav-logo' id='mobile-logo'>      
            <a href='./'>
                <img src='./img/MOBILE_HEADER_LOGO.png' alt=''>
            </a>
        </div>";
    }
    function nav_logo_mobile_2() {
        return "<div class='logo nav-logo' id='mobile-logo'>                
            <div class='logo-text'>
                <a href='./' id='nav-logo'>
                    FindNow
                </a>
            </div>
        </div>";
    }
    function nav_btns() {
        return "<div class='nav-btns'>
            <a id='login-btn' href='#'>Login</a>
            <a id='signup-btn' href='#'>Register</a>
        </div>";
    }
    function nav_links() {
        echo "<div class='nav-links'>
            <a class='login-link' href='./login'>Login</a>
            <a class='signup-link' href='./register'>Sign Up</a>
        </div>";
    }
    function mob_nav_links() {
        echo "<li class='list-item'>
            <a href='./login'>Login</a>
        </li>
        <li class='list-item' style='margin-bottom: 20px;'>
            <a href='./register'>Sign Up</a>
        </li>";
    }
    function percentage($part, $total) {
        return ( $part / $total ) * 100;
    }
    function part() {
        return ( $total * $part ) / 100;
    }
    function get_server_data() {
        $server = $_SERVER['SERVER_NAME']; // localhost
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

        
        $folder = $uriArray[1];
        if($folder === "admin") {
            $path = '../';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[2]);  
            $scriptName = $scriptFull[0];  
            // $scriptType = $scriptFull[1]; 
        } else {
            $path = './';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[1]);
            $scriptName = $scriptFull[0];
            // $scriptType = $scriptFull[1];
        }

        $s = array(
            'server' => $server,
            'uri' => $uriArray,
            'pagename' => $pagename,
            'directory' => $folder,
            'rel_path' => $path,
            'script_name' => $scriptName
            // 'script_type' => $scriptType
        );
        return $s;
    }
    function date_now($tz='Europe/Dublin') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $date = $now->format('Y-m-d');
        return $date;
    }
    function datetime_now($tz='Europe/Dublin') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $datetime = $now->format('Y-m-d H:i:s');
        return $datetime;
    }
    function elapsed($dt_from, $tz='Europe/Dublin') {
        $created_at = new DateTime($dt_from, new DateTimeZone($tz) );
        $date = new DateTime("now", new DateTimeZone($tz) );

        $interval = $date->diff($created_at);
        $elapsed_str = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $elapsed_array = explode(' ', $elapsed_str);
        $elapsed = '';
        if(intval($elapsed_array[0]) > 0) {
            if(intval($elapsed_array[0]) == 1) {
                $elapsed = strval($elapsed_array[0]) . ' yr ago';
            } else {
                $elapsed = strval($elapsed_array[0]) . ' yrs ago';
            }
        } elseif(intval($elapsed_array[2]) > 0) {
            if(intval($elapsed_array[2]) == 1) {
                $elapsed = strval($elapsed_array[2]) . ' month ago';
            } else {
                $elapsed = strval($elapsed_array[2]) . ' months ago';
            }
        } elseif(intval($elapsed_array[4]) > 0) {
            if(intval($elapsed_array[4]) == 1) {
                $elapsed = strval($elapsed_array[4]) . ' day ago';
            } else {
                $elapsed = strval($elapsed_array[4]) . ' days ago';
            }
        } elseif(intval($elapsed_array[6]) > 0) {
            if(intval($elapsed_array[6]) == 1) {
                $elapsed = strval($elapsed_array[6]) . ' hr ago';
            } else {
                $elapsed = strval($elapsed_array[6]) . ' hrs ago';
            }
        } elseif(intval($elapsed_array[8]) > 0) {
            if(intval($elapsed_array[8]) == 1) {
                $elapsed = strval($elapsed_array[8]) . ' min ago';
            } else {
                $elapsed = strval($elapsed_array[8]) . ' mins ago';
            }
        } elseif(intval($elapsed_array[10]) > 0) {
            if(intval($elapsed_array[10]) == 1) {
                $elapsed = strval($elapsed_array[10]) . ' second ago';
            } else {
                $elapsed = strval($elapsed_array[10]) . ' seconds ago';
            }
        }
        return $elapsed;
    }
    function elapsed_check($dt_from, $tz='Europe/Dublin') {
        $created_at = new DateTime($dt_from, new DateTimeZone($tz) );
        $date = new DateTime("now", new DateTimeZone($tz) );

        $interval = $date->diff($created_at);
        $elapsed_str = $interval->format('%y %m %a %h %i %s');
        $elapsed_array = explode(' ', $elapsed_str);

        $years = intval($elapsed_array[1]);
        $months = intval($elapsed_array[2]);
        $days = intval($elapsed_array[3]);
        $hours = intval($elapsed_array[4]);
        $minutes = intval($elapsed_array[5]);

        if($years == 0 && $months == 0 && $days < 5) {
            $e = 1;
        } else {
            $e = 0;
        }
        return $e;
    }
    /*
    function createEmail($email, $subject, $msg) {
        $msg = nl2br($msg);
        
        $to = $email; // Your email address
        
        $msgBody = "
        <p>Name: $name</p>
        <p>Email: $email</p>
        <p>$msg</p>";

        sendEmailSwiftMailer($to, $subject, $msgBody);

    }
    */
    function generatePwdLink($email) {
        // GENERATE PASSWORD LINK
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
    
        
        // This link will be sent to the user by email
        $url = "http://testserver3.ga/confirmation?selector=".$selector."&validator=".bin2hex($token);
        // Expiration date for token (1800ms = 1hr)
        $expires = date("U") + 1800;
        // Insert token in the database (we'll need a new table for this)
    
        // DELETE EXISTING TOKENS
        $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();

        // INSERT NEW TOKEN
        $stmt = $this->con->prepare("INSERT INTO pwd_reset (pwd_reset_email, pwd_reset_selector, pwd_reset_token, pwd_reset_expires) VALUES (?, ?, ?, ?);");
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $email, $selector, $hashedToken, $expires);
        $stmt->execute();
        $stmt->close();

        return $url;
    }
    function sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $to, $subject, $msgBody) {
        // Swiftmailer
        require_once '../vendor/autoload.php'; // In Wordpress, don't require here

        // Create the Transport
        $transport = (new Swift_SmtpTransport($host, $port, $encryption))
        ->setUsername($username) // Email used to send mail
        ->setPassword($pwd) // Password
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
    
        
        $message = (new Swift_Message($subject))
        ->setFrom([$username => 'Armoury Design'])  // Email used to send mail
        ->setTo([$to])
        ->setBody($msgBody,'text/html')
        ;
        // Send the message
        $result = $mailer->send($message);
    }
    function verification_email($email) {
        // SEND THE EMAIL
        $server = $_SERVER['SERVER_NAME'];

        if($server === 'localhost') {
            return;
        } else {
            // Generate verification link
            $url = generatePwdLink($email);

            // Send email
            $to = $email;
            $subject = 'Antelov Verification Email';
            $msgBody = "<p>Verify your email by clicking link below</p>";
            $msgBody .= '<a href="'.$url.'">'.$url.'</a>';
            sendEmailSwiftMailer($to, $subject, $msgBody);  
        }
    }
    function compress($source, $destination, $quality) {

        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        elseif ($info['mime'] == 'image/webp') 
            $image = imagecreatefromwebp($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }
    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $info = getimagesize($file);
        if ($info['mime'] == 'image/jpeg') 
            $src = imagecreatefromjpeg($file);
    
        elseif ($info['mime'] == 'image/gif') 
            $src = imagecreatefromgif($file);
    
        elseif ($info['mime'] == 'image/png') 
            $src = imagecreatefrompng($file);
    
        elseif ($info['mime'] == 'image/webp') 
            $src = imagecreatefromwebp($file);
    
    
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }
    function kv($arr1) {
        $arr2 = array();
        foreach ($arr1 as $key => $value) {
            if($value == 'a') {
                array_push($arr2, $key);
            }
        }
        return $arr2;
    }
    function str_to_str($a) {
        $new_str = '';
        $b = json_decode($a, true);
        // $new_array = explode(",", $new_array);
        if(is_array($b)) {
            if(count($b) > 0) {
                for($s=0; $s < count($b); $s++) {
                    if($s == 0) {
                        $new_str .= $b[$s];
                    } else {
                        $new_str .= ', '.$b[$s];
                    }
                }
                $new_str .= '';
            }
        }
        return $new_str;

    }

    function empty_array($arr) {
        unset($arr);
        $arr = array();
        return $arr;
    }
    function segment($content) {
        $length = strlen($content);
        $content = strip_tags($content);
        if($length > 75) {
            $content = substr($content, 0, 75).'...'; 
        }  
        return $content;
    }
    function read_time($content) {
        $words = explode(' ',$content);
        $time = count($words) / 200;
        $time = explode('.', $time);
        return $time[0];
    }
    function convert_date($d, $f, $zone='Europe/Dublin') {
        $date = new DateTime($d, new DateTimeZone($zone) );
        $dte = $date->format($f);
        return $dte;
    }
    function get_pagename() {
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
        return $pagename;
    }
    function get_folder() {
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        $folder = $uriArray[1];
        return $folder;
    }
?>