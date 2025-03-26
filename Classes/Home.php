<?php

class Home extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    private function startSession() {
        ob_start();
        session_start();
    }
    private function endSession() {
        session_unset();
        session_destroy();
    }
    private function get_top_section() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM top_section WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $top_section = array(
                "id" => $row['id'],
                "background_img" => $row['background_img'],
                "logo" => $row['logo'],
                "logo_subtitle" => $row['logo_subtitle'],
                "title" => $row['title'], 
                "subtitle" => $row['subtitle'],
                "btn_text" => $row['btn_text']
            );       
        endforeach;
        $stmt->close();

        return $top_section;
    }
    public function get_footer_logo() {
        $top_section = $this->get_top_section();
        return "<div class='logo footer-logo'>                
            <div class='logo-text'>
                <a href='./'>
                    Armoury Design
                </a>
            </div>
        </div>";
    }
    public function get_logo() {
        $top_section = $this->get_top_section();
        return "<a href='./'>
            <img style='width: 130px;' src='./img/{$top_section['logo']}' alt=''>
        </a>";
    }
    public function header_content() {
        $top_section = $this->get_top_section();

        $hcStr = "<div class='logo nav-logo'>                
            <a href='./'>
                <img src='./img/{$top_section['logo']}' alt=''>
            </a>
            <div class='subtitle'>{$top_section['logo_subtitle']}</div>
        </div>";
        
        return $hcStr;
    }
    public function updateForm() {
        $top_section = $this->get_top_section();

        if(!isset($_SESSION['v'])) { 
            $_SESSION['v'] = 1; 
            $v = $_SESSION['v'];
        } else {
            $v = floatval($_SESSION['v']) + .1;
            $_SESSION['v'] = $v;
        }

        if(!empty($top_section['logo'])) {
            $img_str = "<div style='width:200px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$top_section['logo']}?v=$v' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/home-handler?type=logo&del={$top_section['logo']}'>Delete</a>
            </div>";
        } else {
            $img_str = "";
        }
        if(!empty($top_section['background_img'])) {
            $img_str_2 = "<div style='width:300px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$top_section['background_img']}?v=$v' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/home-handler?type=bg&del={$top_section['background_img']}'>Delete</a>
            </div>";
        } else {
            $img_str_2 = "";
        }
        return "
        <form autocomplete='off' id='home_form' class='home_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_top_section' id='update_top_section' value='true'>
            <div class='mb-3'>
                <label class='form-label' for='title'>Title: </label>
                <input type='text' name='title' id='title' value='{$top_section['title']}' class='form-control' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label for='title' class='form-label'>Subtitle: </label>
                <input type='text' name='subtitle' id='subtitle' value='{$top_section['subtitle']}' class='form-control' placeholder='Subtitle'>
            </div>
            <div class='mb-3'>
                <label for='logo_subtitle' class='form-label'>Logo Subtitle: </label>
                <input type='text' name='logo_subtitle' id='logo_subtitle' value='{$top_section['logo_subtitle']}' class='form-control' placeholder='Logo Subtitle'>
            </div>
            <div class='mb-3'>
                <label for='title' class='form-label'>Button Text: </label>
                <input type='text' name='btn_text' id='btn_text' value='{$top_section['btn_text']}' class='form-control' placeholder='Button Text'>
            </div>
            $img_str
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Logo</span>
                <span id='image-name-1'></span>
            </span> 
            $img_str_2
            <input class='input' id='background_image' type='file' name='background_image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton2(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Background</span>
                <span id='image-name-2'></span>
            </span> 
            <div>
                <span style='margin-top: 10px;' onclick='return update_home(event)' type='submit' class='btn btn-primary'>Submit</span>  
            </div>
        </form>";
    }
    public function delete_img($img, $type) {
        $id = 1;
        unlink("../img/$img");
        if($type == 'logo') {
            $stmt = $this->con->prepare("UPDATE top_section SET logo=NULL WHERE id=?");
        } elseif($type == 'bg') {
            $stmt = $this->con->prepare("UPDATE top_section SET background_img=NULL WHERE id=?");
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/home");
    }
    public function top_section() {
        $top_section = $this->get_top_section();
        $topStr = "<section class='section-top' id='section-top'>
            <img src='./img/{$top_section['background_img']}' alt=''>
            <div class='section-overlay'></div>
            <div class='top-content'>
                <div class='inner-div'>
                    <div id='site-title'>
                        <h1>{$top_section['title']}</h1>
                    </div>
                    <div id='site-desc'>
                        <p>{$top_section['subtitle']}</p>
                    </div>
                    <div>
                        <a class='cta' href='./quick-quote' onclick=''>{$top_section['btn_text']}</a>
                    </div>
                </div>
                <div class='goto' onclick='scroll_to_element(\"about-section\", event)'>
                    <img src='./img/svg/angle-down.svg' alt=''>
                </div>
            </div>
        </section>";
        
        return $topStr;
    }
    public function update() {
        $id = 1;

        $top_section = $this->get_top_section();

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $btn_text = $_POST['btn_text'];
        $logo_subtitle = $_POST['logo_subtitle'];
        // Logo
        if(!isset($_FILES['logo']['name']) || empty($_FILES['logo']['name'])) {
            $logo = $top_section['logo'];
        } else {
            $logo = add_img('logo');
        }
        // Background Image
        if(!isset($_FILES['background_image']['name']) || empty($_FILES['background_image']['name'])) {
            $background_image = $top_section['background_img'];
        } else {
            $background_image = add_img('background_image');
        }
        
        $stmt = $this->con->prepare("UPDATE top_section SET background_img=?, logo=?, logo_subtitle=?, title=?, subtitle=?, btn_text=? WHERE id=?");
        $stmt->bind_param('ssssssi', $background_image, $logo, $logo_subtitle, $title, $subtitle, $btn_text, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
}


?>