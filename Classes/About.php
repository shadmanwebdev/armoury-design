<?php

class About extends Db {
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
    public function get_about_page() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM about WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $about_page = array(
                "id" => $row['id'],
                "title" => $row['title'],
                "content" => $row['content'], 
                "btn_text" => $row['btn_text'],
                "about_img" => $row['about_img']
            );
        endforeach;
        $stmt->close();

        return $about_page;
    }
    public function about_page_content() {
        $about_page = $this->get_about_page();
        $content = nl2br($about_page['content']);
        return "<div class='about-low-area section-padding2 about-page-content'>
            <div class='container'>
                <div class='row d-flex align-items-center'>
                    <div class='col-lg-6 col-md-12'>
                        <div class='about-caption mb-50'>
                            <div class='section-title mb-35'>
                                <h2>{$about_page['title']}</h2>
                            </div>
                            <div>
                                $content
                            </div>
                            <br>
                            <a href='./get-a-quote' class='btn'>{$about_page['btn_text']}</a>
                        </div>
                    </div>
                    <div class='col-lg-6 col-md-12'>
                        <div class='about-img'>
                            <img src='./img/{$about_page['about_img']}' alt=''>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    public function updateForm() {
        $about_page = $this->get_about_page();
        if(!empty($about_page['about_img'])) {
            $img_str = "<div style='width:200px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$about_page['about_img']}' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/about-handler?id={$about_page['id']}&type=about_img&del={$about_page['about_img']}'>Delete</a>
            </div>";
        } else {
            $img_str = "";
        }
        return "<form autocomplete='off' id='about_form' class='about_form' method='POST'>     
            <div id='msg-response'></div> 
            <input type='hidden' name='update_about' id='update_about' value='true'>                          
            <div class='mb-3'>
                <label class='form-label'>Title</label>
                <input name='title' id='title' type='text' class='form-control' value='{$about_page['title']}' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Content</label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='8'>{$about_page['content']}</textarea>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Button Text</label>
                <input name='btn_text' id='btn_text' type='text' class='form-control' value='{$about_page['btn_text']}' placeholder='Button Text'>
            </div>
            $img_str
            <div style='margin-bottom: 15px;'>
                <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
                <span style='cursor:pointer;' onclick='return fireButton(event);'>
                    <i class='fas fa-paperclip'></i>
                    <span>Image</span>
                    <span id='image-name-1'></span>
                </span> 
            </div>
            <span onclick='return update_about_page(event)' type='submit' class='btn btn-primary'>Submit</span>      
        </form>";
    }
    public function delete_img($img, $type) {
        $id = 1;
        unlink("../img/$img");
        if($type == 'about_img') {
            $stmt = $this->con->prepare("UPDATE about SET about_img=NULL WHERE id=?");
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/about");
    }
    public function update() { 
        $id = 1;
        $about_page = $this->get_about_page($id);

        $title = $_POST['title'];
        $content = $_POST['content'];
        $btn_text = $_POST['btn_text'];

        if(isset($_FILES['image']['name'])) {
            $about_img = add_img('image');
        } else {
            $about_img = $about_page['about_img'];
        }

        
        $stmt = $this->con->prepare("UPDATE about SET title=?, content=?, btn_text=?, about_img=? WHERE id=?");
        $stmt->bind_param('ssssi', $title, $content, $btn_text, $about_img, $id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
}