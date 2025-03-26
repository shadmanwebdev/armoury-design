<?php
/*
    update()
    delete()
    posts
    load_more
    show_posts()
    admin_posts
    createPost()
    editForm()
*/
class Service extends Db {
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
    public function create() {  
        $this->startSession();   
        $title = $_POST['title'];
        $content = $_POST['content'];
        $icon = $_POST['icon'];
        
        // var_dump($title, $content, $created_at, $service_status);
        // $thumbnail = $this->addPostImg('image');

        $stmt = $this->con->prepare("INSERT INTO services(title, content, icon) VALUES (?,?,?)");
        $stmt->bind_param('sss', $title, $content, $icon);
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
    public function createForm() {
        return "<form autocomplete='off' id='service_form' class='service_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_service' id='create_service' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Title</label>
                <input name='title' id='title' type='text' class='form-control' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Content</label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='2'></textarea>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Icon code</label>
                <input name='icon' id='icon' type='text' class='form-control' placeholder='Icon code (eg: ion-ios-analytics-outline)'>
            </div>
            <span onclick='return create_service(event)' type='submit' class='btn btn-primary'>Submit</span>
            
        </form>";
    }
    public function updateForm() {
        return "<form autocomplete='off' id='service_form' class='service_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_service' id='create_service' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Title</label>
                <input name='title' id='title' type='text' class='form-control' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Content</label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='2'></textarea>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Icon code</label>
                <input name='icon' id='icon' type='text' class='form-control' placeholder='Icon code (eg: ion-ios-analytics-outline)'>
            </div>
            <span onclick='return create_service(event)' type='submit' class='btn btn-primary'>Submit</span>
            
        </form>";
    }
    public function get_service($id) {
        $stmt = $this->con->prepare("SELECT * FROM services WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $service_array = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'content' => $row['content'],
                        'icon' => $row['icon']
                    );
                    array_push($services_array, $service_array);          
                endforeach;
            } 
        }
        $stmt->close();
        return $services_array;
    }
    public function get_services() {
        $services_array = array();
        $stmt = $this->con->prepare("SELECT * FROM services ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $service_array = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'content' => $row['content'],
                        'icon' => $row['icon']
                    );
                    array_push($services_array, $service_array);          
                endforeach;
            } 
        }
        $stmt->close();
        return $services_array;
    }
    public function services() {
        $services_array = $this->get_services();

        if(count($services_array) > 0) {
            $services = "";
            foreach($services_array as $service_array):
                $services .= "
                <div class='col-md-6 col-lg-4 wow bounceInUp' data-wow-duration='1.4s'>
                    <div class='box'>
                        <div class='icon'>
                            <i class='{$service_array['icon']}'></i>
                        </div>
                        <h4 class='title'>
                            <a href=''>{$service_array['title']}</a>
                        </h4>
                        <p class='description'>
                            {$service_array['content']}
                        </p>
                    </div>
                </div>";
            endforeach;
        }

        return $services;
    }
    public function admin_posts($orderBy, $direction, $limit=null, $post_status='public') {
        $posts_array = $this->get_posts($orderBy, $direction, $limit, $post_status);
        $posts = "";
        if(count($posts_array) > 0) {
            $posts .= "<div class='admin_posts_wrapper'>";
            foreach($posts_array as $post_array):
                $posts .= "<div class='post post_admin'>
                <div class='post_row'>
                    <div class='img_wrapper'>
                        <img src='../img/{$post_array['thumbnail']}' alt=''>
                    </div>
                    <div class='admin_post_title'>
                        <a href='../post-single?id={$post_array['id']}'>{$post_array['title']}</a>
                    </div>
                    <div class='post-short'>
                    </div>
                    <div class='upload_date'>{$post_array['elapsed']}</div>
                    <span class='admin_post-links'>
                        <a title='edit' class='edit-link' href='post-edit?id={$post_array['id']}'>Edit</a>
                        <a title='delete' onclick='return pop(this)' class='del-link' href='../controllers/post-handler?delete_post={$post_array['id']}'>Delete</a>
                    </span>
                </div>
            </div>";
            endforeach;
            $posts .= "</div>";
        }

        return $posts;
    }
}

?>