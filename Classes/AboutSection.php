<?php

class AboutSection extends Db {
    public function __construct() {
        $this->con = $this->con();
    }
    private function startSession() {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }
    }
    private function endSession() {
        if(isset($_SESSION)) { 
            session_unset();
            session_destroy();
        }
    }
    public function get_about_section() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM about_section WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $about_section = array(
                "id" => $row['id'],
                "title" => $row['title'],
                "subtitle" => $row['subtitle'],
                "content" => $row['content'], 
                "btn_text" => $row['btn_text'],
                "about_img" => $row['about_img'],
                "about_text_1" => $row['about_text_1'],
                "about_text_2" => $row['about_text_2'],
                "about_text_3" => $row['about_text_3'],
                "about_text_4" => $row['about_text_4']
            );
        endforeach;
        $stmt->close();

        return $about_section;
    }
    public function about_section() {
        $about_section = $this->get_about_section();
        $content = nl2br($about_section['content']);
        return "<div class='about-section' id='about-section'>
            <div class='container'>
                <div class='row align-items-center'>
                    <div class='col-lg-7 img-years mb-lg-0'>
                        <img src='./img/{$about_section['about_img']}' alt='Image' class='img-fluid'>
                    </div>
                    <div class='col-lg-4 ml-auto'>
                        <span class='sub-title'>{$about_section['subtitle']}</span>
                        <h2 class='sec-ttl mb-4'>{$about_section['title']}</h2>
                        <p class='mb-4'>
                            $content
                        </p>
                        <ul class='list-unstyled ul-check text-left success mb-5'>
                            <li>
                                {$about_section['about_text_1']}
                            </li>
                            <li>
                                {$about_section['about_text_2']}
                            </li>
                            <li>
                                {$about_section['about_text_3']}
                            </li>
                            <li>
                                {$about_section['about_text_4']}
                            </li>
                        </ul>
                        <p>
                            <a href='./about' class='btn btn-primary btn-lg rounded-0'>{$about_section['btn_text']}</a>
                        </p>
                    </div>
                </div>  
            </div>
        </div>";
    }
    public function updateForm() {
        $about_section = $this->get_about_section();
        if(!empty($about_section['about_img'])) {
            $img_str = "<div style='width:200px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$about_section['about_img']}' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/about-section-handler?id={$about_section['id']}&type=about_img&del={$about_section['about_img']}'>Delete</a>
            </div>";
        } else {
            $img_str = "";
        }
        return "<form autocomplete='off' id='about_form' class='about_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_about_summary' id='update_about_summary' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Title</label>
                <input name='title' id='title' type='text' class='form-control' value='{$about_section['title']}' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Subtitle</label>
                <input name='subtitle' id='subtitle' type='text' class='form-control' value='{$about_section['subtitle']}' placeholder='Subtitle'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Content</label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='8'>{$about_section['content']}</textarea>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Button Text</label>
                <input name='btn_text' id='btn_text' type='text' class='form-control' value='{$about_section['btn_text']}' placeholder='Button Text'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>About List</label>
                <input name='about_text_1' id='about_text_1' type='text' class='form-control' value='{$about_section['about_text_1']}' placeholder=''>
            </div>
            <div class='mb-3'>
                <input name='about_text_2' id='about_text_2' type='text' class='form-control' value='{$about_section['about_text_2']}' placeholder=''>
            </div>
            <div class='mb-3'>
                <input name='about_text_3' id='about_text_3' type='text' class='form-control' value='{$about_section['about_text_3']}' placeholder=''>
            </div>
            <div class='mb-3'>
                <input name='about_text_4' id='about_text_4' type='text' class='form-control' value='{$about_section['about_text_4']}' placeholder=''>
            </div>
            $img_str
            <div>
                <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
                <span style='cursor:pointer;' onclick='return fireButton(event);'>
                    <i class='fas fa-paperclip'></i>
                    <span>Thumbnail</span>
                    <span id='image-name-1'></span>
                </span>
            </div>
            <span onclick='return update_about_section(event)' type='submit' class='btn btn-primary'>Submit</span>      
        </form>";
    }
    public function update() {
        $id = 1;

        $about_section = $this->get_about_section();

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];
        $btn_text = $_POST['btn_text'];
        
        $about_text_1 = $_POST['about_text_1'];
        $about_text_2 = $_POST['about_text_2'];
        $about_text_3 = $_POST['about_text_3'];
        $about_text_4 = $_POST['about_text_4'];

        if(!isset($_FILES['image']['name']) || empty($_FILES['image']['name'])) {
            $about_img = $about_section['about_img'];
        } else {
            $about_img = add_img('image');
        }
        
        $stmt = $this->con->prepare("UPDATE about_section SET title=?, subtitle=?, content=?, btn_text=?, about_img=?, about_text_1=?, about_text_2=?, about_text_3=?, about_text_4=? WHERE id=?");
        $stmt->bind_param('sssssssssi', $title, $subtitle, $content, $btn_text, $about_img, $about_text_1, $about_text_2, $about_text_3, $about_text_4, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function delete_img($img, $type) {
        $id = 1;
        unlink("../img/$img");
        if($type == 'about_img') {
            $stmt = $this->con->prepare("UPDATE about_section SET about_img=NULL WHERE id=?");
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/about-section");
    }
}