<?php
/*
    show_user_profile()
    update_password
*/
class User extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    public function startSession() {
        ob_start();
        session_start();
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    public function email_exists($email) {
        // Check if email exists
        $account_status = 'public';
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    public function generatePwdLink($email) {
        // GENERATE PASSWORD LINK
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        
        // This link will be sent to the user by email
        $url = "https://testserver3.ga/armoury-design/new-password?selector=".$selector."&validator=".bin2hex($token);
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
    public function update_password() {
        $this->startSession();
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $repeat_password = $_POST['repeat_password'];

        $uid = get_uid();

        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $password_check = password_verify($current_password, $row['pwd']);
        endforeach;

        if($password_check == true && $new_password == $repeat_password) {
            $updated_at = datetime_now();
            $options = [
                'cost' => 11
            ]; 
            // $pwd = password_hash($password, PASSWORD_DEFAULT);
            $pwd = password_hash($new_password, PASSWORD_BCRYPT, $options);
            $stmt = $this->con->prepare("UPDATE users SET pwd=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssi', $pwd, $updated_at, $uid);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
        } else {
            $status = '0';
        }
        echo $status;
    }
    public function update_password_2() {
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $password = $_POST['new_password'];
        $password_repeat = $_POST['repeat_password'];
        
        if(empty($password) || empty($password_repeat)) {
            $status = '4';
        } else if ($password != $password_repeat) {
            $status = '5';
        } else {
            $current_date = date("U"); 
        
            // SELECT
            // var_dump($_POST);
            $stmt = $this->con->prepare("SELECT * FROM pwd_reset WHERE pwd_reset_selector=? AND pwd_reset_expires>=?");
            $stmt->bind_param('ss', $selector, $current_date);
            $stmt->execute();
            // $stmt->store_result();
            $result = $stmt->get_result();
        
            if ($result->num_rows == 0) {
                $status = '8';
            } else {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row):
                    $token_bin = hex2bin($validator);
                    $token_check = password_verify($token_bin, $row['pwd_reset_token']);
                endforeach;

                if($token_check === false) {
                    $status = '7';
                    // echo "You need to resubmit your reset request.";
                    // exit();
                } elseif($token_check === true) {
                    $token_email = $row['pwd_reset_email'];
    
                    // SELECT FROM users TABLE
                    $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
                    $stmt->bind_param('s', $token_email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows == 0) {
                        $status = '0';
                    } else {
                        // UPDATE PASSWORD
                        $stmt = $this->con->prepare("UPDATE users SET pwd=? WHERE email=?");
                        $pwdHash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                        $stmt->bind_param('ss', $pwdHash, $token_email);
                        $stmt->execute();    
                        // DELETE TOKEN
                        $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
                        $stmt->bind_param('s', $token_email);
                        $stmt->execute();
                        
                        $status = '1';
                    }
                    $stmt->close();
                }
            }    
        }    
        echo $status;
    }
    public function get_uid() {
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
    public function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
    }
    public function get_user_photo() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
            return $photo;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
            return $photo;
        }
    }
    public function firstname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $fname = $userdata['fname'];
            return $fname;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $fname = $userdata['fname'];
            return $fname;
        }
    }
    public function lastname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $lname = $userdata['lname'];
            return $lname;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $lname = $userdata['lname'];
            return $lname;
        }
    }
    public function username() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $username = $userdata['username'];
            return $username;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $username = $userdata['username'];
            return $username;
        }
    }
    public function get_user_status() {
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
    public function get_account_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        }
    }   
    public function account_type() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $account_type = $userdata['account_type'];
            return $account_type;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $account_type = $userdata['account_type'];
            return $account_type;
        }
    }   
    public function get_user_email() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $email = $userdata['email'];
            return $email;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $email = $userdata['email'];
            return $email;
        }
    }  
    public function get_user_img() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
            if(empty($photo)) {
                $photo = 'avi.png';
            }
            return $photo ;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
            if(empty($photo)) {
                $photo = 'avi.png';
            }
            return $photo ;
        }
    }
    public function login() {
        $this->startSession();

        $email = $_POST['email'];
        $password = $_POST['password'];     

        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):   
                    $hash = trim($row['pwd']);
                    if(password_verify($password, $hash)) {
                    // if($password === trim($row['pwd'])) {
                        if($row['account_status'] == 'active') {
                            $userdata = array(
                                'logged' => '1',
                                'uid' => $row['id'],
                                'fname' => $row['fname'],
                                'lname' => $row['lname'],
                                'username' => $row['username'],
                                'email' => $row['email'],
                                'photo' => $row['photo'],
                                'user_status' => $row['user_status'],
                                'account_status' => $row['account_status']
                            );
                            $_SESSION['user'] = json_encode($userdata, true);
                            if (isset($_POST["remember"])) {
                                setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
                            }
                            if($row['user_status'] == 'admin') {
                                $status = '1';
                            } else if ($row['user_status'] == 'member') {
                                $status = '2';
                            } else {
                                $status = '5';
                            }
                        } else {
                            $status = '6';
                        }
                    } else {
                        $status = '3';
                    }
                endforeach;
            } else {
                $status = '4';
            }  
        } else {
            $status = '4';
        }       
        $stmt->close();
        echo $status;
    }
    public function logout() {
        $this->startSession();
        $this->endSession();
        setcookie('user', '', 1, '/');
        header('location: ../'); 
    }
    public function check_user_session() {
        // var_dump($_COOKIE['user'], $_SESSION['user']);
        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
        if($_SERVER['SERVER_NAME'] == 'localhost') {
            $folder = $uriArray[2];
        } else {
            $folder = $uriArray[1];
        }
        /*
            1. Folder is admin but user not logged in
            2. User is logged in but not admin
        */
        if($folder == 'admin') {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                if($userdata['user_status'] != 'admin') {
                    header('location: ../');
                    exit();
                }
            } else {
                if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
                    header('location: ../');
                    exit();
                } else {
                    $userdata = json_decode($_SESSION['user'], true);
                    if($userdata['user_status'] != 'admin') {
                        header('location: ../');
                        exit();
                    }
                }
            }
        }    
        
    }
    public function duplicate_email($email) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    public function create() {
        $this->startSession();
  
        $email = $_POST['email'];  

        $duplicate = $this->duplicate_email($email);
        if($duplicate == '1') {
            $status = '2';
        } else {
            $account_type = $_POST['account_type'];
                
            $phone = $_POST['phone'];
            if($account_type == 'business') {
                $bname = $_POST['bname'];
            } else {
                $fname = $_POST['fname'];  
                $lname = $_POST['lname'];  
            }
            $created_at = datetime_now();    
            $updated_at = $created_at;

            $password = $_POST['pwd'];
            $options = [
                'cost' => 11
            ];
            // $pwd = password_hash($password, PASSWORD_DEFAULT);
            $pwd = password_hash($password, PASSWORD_BCRYPT, $options);

            // var_dump($email, $password, $user_status, $created_at, $updated_at);
            if($account_type == 'personal') {
                $stmt = $this->con->prepare("INSERT INTO users(fname, lname, email, phone, pwd, account_type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $pwd, $account_type, $created_at);
                if($stmt->execute()) {
                    $_SESSION['confirmation_email'] = $email; 
                    $status = '1';
                } else {
                    $status = '0';
                }
                $stmt->close();
            } else {
                $stmt = $this->con->prepare("INSERT INTO users(fname, email, phone, pwd, account_type, created_at) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $bname, $email, $phone, $pwd, $account_type, $created_at);
                if($stmt->execute()) {
                    $_SESSION['confirmation_email'] = $email; 
                    $status = '1';
                } else {
                    $status = '0';
                }
                $stmt->close();
            }
        }
        echo $status;
    }

    public function get_user($id) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $user_array = array(
                        'id' => $row['id'],
                        'fname' => $row['fname'],
                        'lname' => $row['lname'],
                        'username' => $row['username'],
                        'bio' => $row['bio'],
                        'email' => $row['email'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'pwd' => $row['pwd'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at']
                    );
                    // var_dump($user_array);
                endforeach;
            }    
        }
        $stmt->close();
        return $user_array;
    }
    public function update() {
        $uid = get_uid();
        $updated_at = datetime_now();
    }
    public function smtp_details() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM smtp_email_setup WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $smtp_details = array(
                        'smtp_host' => $row['smtp_host'],
                        'smtp_encryption' => $row['smtp_encryption'],
                        'smtp_port' => $row['smtp_port'],
                        'username' => $row['username'],
                        'pwd' => $row['pwd']
                    );
                endforeach;
            } 
        }
        $stmt->close();
        return $smtp_details;
    }
    public function profile_photo() {
        $photo = $this->get_user_img();
        $username = $this->username();
        $fname = $this->firstname();
        $lname = $this->lastname();
        if(!empty($photo)) {
            $profile_photo = "<img src='../img/$photo' class='avatar img-fluid rounded mr-1' alt='$fname $lname' /> <span class='text-dark'>$fname $lname</span>";
        } else {
            $profile_photo = "<img src='../img/avi.png' class='avatar img-fluid rounded mr-1' alt='$fname $lname' /> <span class='text-dark'>$fname $lname</span>";
        }
        echo $profile_photo;
    }
    public function public_info_form() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        if(!empty($user_array['photo'])) {
            $profile_img = "<img id='pfp-img-preview' src='../img/{$user_array['photo']}' alt='{$user_array['username']}' class='rounded-circle img-responsive mt-2' width='128' height='128' />";
        } else {
            $profile_img = "<img id='pfp-img-preview' src='../img/avi.png' alt='{$user_array['username']}' class='rounded-circle img-responsive mt-2' width='128' height='128' />";

        }
        echo "<form runat='server'>
            <div id='msg-response1'></div>
            <input type='hidden' id='update_public_info' name='update_public_info' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value='{$user_array['username']}'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'>{$user_array['bio']}</textarea>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        $profile_img
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>
            </div>

            <span onclick='update_public_info(event)' type='submit' class='btn btn-primary'>Save changes</span>
        </form>";
    }
    public function update_public_info() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = $user_array['photo'];
        } else {
            $photo = add_img('photo');
        }
        $stmt = $this->con->prepare("UPDATE users SET username=?, bio=?, photo=? WHERE id=?");
        $stmt->bind_param('sssi', $username, $bio, $photo, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function private_info_form() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        echo "<form>
            <div id='msg-response2'></div>
            <input type='hidden' id='update_private_info' name='update_private_info' value='true'>
            <div class='row'>
                <div class='mb-3 col-md-6'>
                    <label class='form-label' for='fname'>First name</label>
                    <input type='text' class='form-control' id='fname' name='fname' placeholder='First name' value='{$user_array['fname']}'>
                </div>
                <div class='mb-3 col-md-6'>
                    <label class='form-label' for='lname'>Last name</label>
                    <input type='text' class='form-control' id='lname' name='lname' placeholder='Last name' value='{$user_array['lname']}'>
                </div>
            </div>
            <div class='mb-3'>
                <label class='form-label' for='email'>Email</label>
                <input type='email' class='form-control' id='email' name='email' placeholder='Email' value='{$user_array['email']}'>
            </div>
            <span onclick='update_private_info(event)' type='submit' class='btn btn-primary'>Save changes</span>
        </form>";
    }
    public function update_private_info() {
        $id = get_uid();
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $stmt = $this->con->prepare("UPDATE users SET fname=?, lname=?, email=? WHERE id=?");
        $stmt->bind_param('sssi', $fname, $lname, $email, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function smtpEmailForm() {
        $smtp_details = $this->smtp_details();
        if($smtp_details['smtp_encryption'] == 'SSL') {
            $opts = "<option value='SSL' selected>SSL</option>
            <option value='TLS'>TLS</option>";
        } else if ($smtp_details['smtp_encryption'] == 'TLS') {
            $opts = "<option value='TLS' selected>TLS</option>
            <option value='SSL'>SSL</option>";
        } else {
            $opts = "<option selected=''>Select Encryption</option>
            <option value='SSL'>SSL</option>
            <option value='TLS'>TLS</option>";
        }
        return "<form autocomplete='off' method='POST' class='add-post-form update-user-form' id='update-user-form'  enctype='multipart/form-data'>
        <div id='msg-response'></div>
            <input type='hidden' name='email_setup' id='email_setup' value='true'>
            <div class='mb-3'>
                <label for='smtp_host' class='form-label'>SMTP Host</label>
                <input name='smtp_host' id='smtp_host' type='text' class='form-control' placeholder='SMTP Host' value='{$smtp_details['smtp_host']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Encryption</label>
                <select class='form-control' name='smtp_encryption' id='smtp_encryption'>
                    $opts
                </select>
            </div>
            <div class='mb-3'>
                <label for='smtp_port' class='form-label'>SMTP Port</label>
                <input name='smtp_port' id='smtp_port' type='text' class='form-control' placeholder='SMTP Port' value='{$smtp_details['smtp_port']}'>
            </div>
            <div class='mb-3'>
                <label for='username' class='form-label'>Username</label>
                <input name='username' id='username' type='text' class='form-control' placeholder='Username' value='{$smtp_details['username']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Password</label>
                <input name='password' id='password' type='password' class='form-control' placeholder='Password' value='{$smtp_details['pwd']}'>
            </div>
            <div>
                <span onclick='return email_setup(event)' type='submit' class='btn btn-primary'>Submit</span>
            </div>
        </form>";
    }
    public function update_email_details() {
        $id = 1;
        $smtp_host = $_POST['smtp_host'];
        $smtp_encryption = $_POST['smtp_encryption'];
        $smtp_port = $_POST['smtp_port'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $stmt = $this->con->prepare("UPDATE smtp_email_setup SET smtp_host=?, smtp_encryption=?, smtp_port=?, username=?, pwd=? WHERE id=?");
        $stmt->bind_param('sssssi', $smtp_host, $smtp_encryption, $smtp_port, $username, $pwd, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
}