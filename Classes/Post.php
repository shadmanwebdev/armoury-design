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
class Post extends Db {
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
        $author = $_POST['author'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $created_at = datetime_now();
        $service_status = 'public';
        
        // var_dump($title, $content, $created_at, $service_status);
        $thumbnail = $this->addPostImg('image');

        $stmt = $this->con->prepare("INSERT INTO posts(title, content, thumbnail, service_status, created_at) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $title, $content, $thumbnail, $service_status, $created_at);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        // echo $status;
        header("location: ../admin/services.php");
    }
    public function get_posts(
        $orderBy='id', 
        $direction='DESC', 
        $limit=null, 
        $post_status='public'
    ) {
        $posts_array = array();
        if($limit == null) {
            $stmt = $this->con->prepare("SELECT * FROM posts WHERE post_status=? ORDER BY $orderBy $direction");
            $stmt->bind_param('s', $post_status); 
        } else {
            $stmt = $this->con->prepare("SELECT * FROM posts WHERE post_status=? ORDER BY $orderBy $direction LIMIT $limit");
            $stmt->bind_param('s', $post_status); 
        } 
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $post_array = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'summary' => $row['summary'],
                        'details' => $row['details'],
                        'thumbnail' => $row['thumbnail'],
                        'post_status' => $row['post_status'],
                        'post_category' => $row['post_category'],
                        'tags' => $row['tags'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'likes' => $row['likes'],
                        'mjy' => convert_date($row['created_at'], 'M j Y'),
                        'elapsed' => elapsed($row['created_at'])
                    );
                    array_push($posts_array, $post_array);          
                endforeach;
            } 
        }
        $stmt->close();
        return $posts_array;
    }
    public function posts(
        $orderBy='id', 
        $direction='DESC', 
        $limit=null, 
        $post_status='public'
    ) {
    //     <div class='like' id='like-{$post_array['id']}' onclick='like({$post_array['id']})'>
    //     <i class='fa fa-thumbs-up'></i>
    // </div>
        $posts_array = $this->get_posts($orderBy, $direction, $limit, $post_status);

        if(count($posts_array) > 0) {
            $posts = "<div class='blog-section'>
                <div class='posts blog-posts'>
                    <div class='inner-div' id='posts-inner-div'>";
            foreach($posts_array as $post_array):
                $posts .= "
                <div class='post post-summary'>
                    <div class='thumbnail'>
                        <a href='./post?id={$post_array['id']}'>
                            <img src='./img/post/{$post_array['thumbnail']}' alt=''>
                        </a>
                    </div>
                    <div class='post-main'>
                        <div class='post-body'>
                            <a href='./post?id={$post_array['id']}'>
                                <h3>
                                    {$post_array['title']}
                                </h3>
                            </a>
                            <div class='post-content'>
                                {$post_array['summary']}
                            </div>
                        </div>
                    </div>
                    <div class='post-footer'>

                    </div>
                </div>";
            endforeach;
            $posts .= "</div></div>
                <div class='load-rows' id='load-rows'></div>
            </div>";
        }

        return $posts;
    }
    public function search_count($search, $post_status='public') {
        $stmt = $this->con->prepare("SELECT * FROM posts WHERE post_status=? AND (post_category LIKE '%$search%' || tags LIKE '%$search%')");
        $stmt->bind_param('s', $post_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $post_count = count($data);
        echo $post_count;
    }
    public function get_search_posts(
        $search, 
        $orderBy='id', 
        $direction='DESC', 
        $limit=null, 
        $post_status='public'
    ) {
        // var_dump($search);
        $posts_array = array();
        if($limit == null) {
            $stmt = $this->con->prepare("SELECT * FROM posts WHERE post_status=? AND (title LIKE '%$search%' || summary LIKE '%$search%' || details LIKE '%$search%' ||  post_category LIKE '%$search%' || tags LIKE '%$search%') ORDER BY $orderBy $direction");
            $stmt->bind_param('s', $post_status); 
        } else {
            $stmt = $this->con->prepare("SELECT * FROM posts WHERE post_status=? AND (title LIKE '%$search%' || summary LIKE '%$search%' || details LIKE '%$search%' ||  post_category LIKE '%$search%' || tags LIKE '%$search%') ORDER BY $orderBy $direction LIMIT $limit");
            $stmt->bind_param('s', $post_status); 
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $post_array = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'summary' => $row['summary'],
                        'details' => $row['details'],
                        'thumbnail' => $row['thumbnail'],
                        'post_status' => $row['post_status'],
                        'post_category' => $row['post_category'],
                        'tags' => $row['tags'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'likes' => $row['likes'],
                        'mjy' => convert_date($row['created_at'], 'M j Y'),
                        'elapsed' => elapsed($row['created_at'])
                    );
                    array_push($posts_array, $post_array);          
                endforeach;
            } 
        }
        $stmt->close();
        return $posts_array;
    }
    public function search_posts(
        $search,
        $orderBy='id',
        $direction='DESC',
        $limit=null,
        $post_status='public'
    ) {
        $posts_array = $this->get_search_posts($search);

        $posts = "";
        if(count($posts_array) > 0) {
            foreach($posts_array as $post_array):
                $posts .= "
                <div class='post post-summary'>
                    <div class='thumbnail'>
                        <a href='./post?id={$post_array['id']}'>
                            <img src='./img/post/{$post_array['thumbnail']}' alt=''>
                        </a>
                    </div>
                    <div class='post-main'>
                        <div class='post-body'>
                            <a href='./post?id={$post_array['id']}'>
                                <h3>
                                    {$post_array['title']}
                                </h3>
                            </a>
                            <div class='post-content'>
                                {$post_array['summary']}
                            </div>
                        </div>
                    </div>
                    <div class='post-footer'>
                    </div>
                </div>";
            endforeach;
        } else {
            $posts .= "<p style='margin-top: 95px'>We didn't find any results for the search <em>'$search'</em>.</p>";
        }

        echo $posts;
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
    public function get_single_post($id) {   
        $id = intval($id);    
        $stmt = $this->con->prepare("SELECT * FROM posts JOIN users ON posts.posted_by = users.id WHERE posts.id=? LIMIT 1");    
        $stmt->bind_param('i', $id);   
        $stmt->execute();    
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):
                    $post_array = array(
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'summary' => $row['summary'],
                        'details' => $row['details'],
                        'thumbnail' => $row['thumbnail'],
                        'post_status' => $row['post_status'],
                        'post_category' => $row['post_category'],
                        'tags' => $row['tags'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'likes' => $row['likes'],
                        'mjy' => convert_date($row['created_at'], 'M j Y'),
                        'elapsed' => elapsed($row['created_at']),
                        'city' => $row['city'],
                        'fname' => $row['fname'],
                        'phone' => $row['phone']
                    );   
                endforeach;
            } 
        } 
        $stmt->close();
        return $post_array;
    }
    public function single_post($pid) { 
        $post_array = $this->get_single_post($pid);

        $slug = "post?id=$pid";

        // if(isset($_SESSION['like'.$pid])) {
        //     if($_SESSION['like'.$pid] == '1') {
        //         $likes = "<span id='like-{$post_array['id']}' class='like-{$post_array['id']}'>
        //             {$post_array['likes']}
        //         </span>
        //         <i class='fas fa-heart' onclick='like({$post_array['id']})'></i>";
        //     } else {
        //         $likes = "<span id='like-{$post_array['id']}' class='like-{$post_array['id']}'>
        //             {$post_array['likes']}
        //         </span>
        //         <i class='far fa-heart' onclick='like({$post_array['id']})'></i>";
        //     }
        // } else {
        //     $likes = "<span id='like-{$post_array['id']}' class='like-{$post_array['id']}'>
        //         {$post_array['likes']}
        //     </span>
        //     <i class='far fa-heart' onclick='like({$post_array['id']})'></i>";
        // }
        // $popupId = 'link_popup';

        // // Url and Slug for social media sharing
        // if($_SERVER['SERVER_NAME'] == 'smartmoneymovement.test') {
        //     $baseurl = 'https://smartmoneymovement.test/';
        // } else {
        //     $baseurl = 'https://smartmoneymovement.us/';
        // }
        

        $post = "<div class='post post-single'>
            <div class='post-content'>
                <div class='post-header'>
                    <div class='col' id='col-1'>
                        <div class='post-title'>
                            <h3>{$post_array['title']}</h3>
                        </div>
                        <div class='thumbnail'>
                            <img src='./img/post/{$post_array['thumbnail']}' alt=''>
                        </div>
                    </div>
                    <div class='col' id='col-2'>
                        <div class='posted-by'>
                            <h3>{$post_array['fname']}</h3>
                        </div>
                        <div class='city'>
                            <span class='icon'>
                                <img src='./img/svg/location-dot.svg' alt='location'>   
                            </span>
                            <span>
                                {$post_array['city']}
                            </span>
                        </div>
                        <div class='city'>
                            <span class='icon'>
                                <img src='./img/svg/phone.svg' alt='location'>   
                            </span>
                            <span>
                                {$post_array['phone']}
                            </span>
                        </div>
                        <div class='ok-tnx'>
                            Ok, Thanks
                        </div>
                    </div>
                </div>

                <div class='post-body'>
                    <h3>Details</h3>
                    <div class='post-details'>
                        {$post_array['details']}
                    </div>
                </div>
            </div>
        </div>";
        return $post;

        // <div class='share-btn linkedin'>
        //     <a target='_blank' class='icon-linkedin-share' href='http://www.linkedin.com/shareArticle?mini=true&url=$baseurl$slug&title=$title&summary=$content&source=smartmoneymovement.us'>
                    
        //     </a>
        // </div>

    }
    private function addPostImg($n) {
        // $img = $_FILES['image']['name'];
        $image = $_FILES[$n]['name'];
        // CHECK IF INPUT IS EMPTY
        if(!empty($image)) {
            $allowed = array('png', 'jpg', 'jpeg', 'webp');
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                $staus = '2';
                // echo '<span class=errorMsg>Incorrect File Type</span>';
                exit();
            } else {
                $imagePath = '../img/';
                $uniquesavename = intval(time().uniqid(rand(10, 20)));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                $tempname = $_FILES[$n]['tmp_name'];
                move_uploaded_file($tempname,  $destFile);
                $img = $uniquesavename . '.'.$ext;
            }
        } else {
            $img = '';
        }
        return $img;
    }
    public function delete($id) {
        // Get old filename
        $stmt = $this->con->prepare("SELECT * FROM services WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();   
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $old_thumbnail = $row['thumbnail'];
                endforeach;
            }
        }
        $stmt->close();

        // Delete old image
        $this->del_thumbnail($old_thumbnail, $id);

        $stmt = $this->con->prepare("DELETE FROM services WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/services');
    }
    public function update($id) {
        $this->startSession(); 
        $id = intval($id);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $thumbnail = $this->addPostImg('image');
        if(empty($thumbnail)) {
            $stmt = $this->con->prepare("UPDATE services SET title=?, content=? WHERE id=?");
            $stmt->bind_param('ssi', $title, $content, $id);
        } else {
            $stmt = $this->con->prepare("UPDATE services SET title=?, content=?, thumbnail=? WHERE id=?");
            $stmt->bind_param('sssi', $title, $content, $thumbnail, $id);
        }

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }    
        $stmt->close();
        // echo $status;
        header("location: ../admin/services.php");
    }
    public function increase_view_count($id) {
        $id = intval($id);
        $stmt = $this->con->prepare("UPDATE posts SET views=views+1 WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
    public function trash($id) {
        $post_status = 'deleted';
        $stmt = $this->con->prepare("UPDATE posts SET post_status=? WHERE id=?");
        $stmt->bind_param('si', $post_status, $id);        
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }    
        $stmt->close();
        echo $status;
    }
    public function del_thumbnail($thumbnail, $pid) {
        unlink("../img/$thumbnail");
        $stmt = $this->con->prepare("UPDATE services SET thumbnail=NULL WHERE id=?");
        $stmt->bind_param('i', $pid);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/post-edit?id=$pid");
    }
    public function createForm() {
        // onsubmit='return addPost(event)'
        return "<form autocomplete='off' action='../controllers/post-handler' method='POST' class='post-form add-post-form adm-form' id='add-post-form'  enctype='multipart/form-data'>
            <input type='hidden' name='create_post' value='true'>
            <input type='hidden' name='author' value='Author Name'>
            <div class='input-col input-col-2'>
                <label for='title'>Title: </label>
                <input type='text' name='title' id='title'>
            </div>
            <div class='input-col input-col-2'>
                <label for='content'>Content: </label>
                <textarea name='content' id='content' class='content'></textarea>
            </div> 
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Thumbnail</span>
                <span id='image-name-1'></span>
            </span> 
            <div class='btns-wrapper admin-form-btns'>
                <span class='cancel'>
                    <a class='cancel' href='./services'>Cancel</a>
                </span>
                <button type=submit class='btn'>Create</button>
            </div>
            <div id='msg-response'></div>
        </form>";
    }
    public function editForm($id) {
        // onsubmit='return updatePost(event)'
        $post_array = $this->get_single_post($id);
        
        $title = $post_array['title'];
        $content = $post_array['content'];
        $thumbnail = $post_array['thumbnail'];

        if(!empty($thumbnail)) {
            $img_str = "<div style='width:300px;height:200px;'>
                    <img style='width:100%;height:100%;object-fit:cover;' src='../img/$thumbnail' alt=''>
                </div>
                <div>
                    <a title='delete' class='del-link' href='../controllers/post-handler?pid=$id&del=$thumbnail'>Delete</a>
                </div>";
        } else {
            $img_str = "";
        }
        return "<form autocomplete='off' action='../controllers/post-handler' method='POST' class='post-form edit-post-form adm-form' id='edit-post-form' enctype='multipart/form-data'>
            <input type='hidden' name='update_post' value='true'>
            <input type='hidden' name='post_id' value='$id'>
            <div class='input-col input-col-2'>
                <label for='title'>Title: </label>
                <input type='text' name='title' id='title' value='$title' placeholder='Title for this post'>
            </div>
            <div class='form-group'>
                <textarea name='content' id='content' class='content'>$content</textarea>
            </div>
            $img_str
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Thumbnail</span>
                <span id='image-name-1'></span>
            </span>
            <div class='btns-wrapper admin-form-btns'>
                <span class='cancel'>
                    <a class='cancel' href='./posts'>Cancel</a>
                </span>
                <button type=submit class='btn'>Update</button>
            </div>
            <div id='msg-response'></div>
        </form>";
    }
    public function load_more($orderBy='id', $direction='DESC', $limit=null, $post_status='public') {
        $posts_array = $this->get_posts($orderBy, $direction, $limit, $post_status);
        
        $posts = "";
        if(count($posts_array) > 0) {
            

            foreach($posts_array as $post_array):
                $posts .= "
                <div class='post post-summary'>
                    <div class='thumbnail'>
                        <a href=''>
                            <img src='./img/post/{$post_array['thumbnail']}' alt=''>
                        </a>
                    </div>
                    <div class='post-main'>
                        <div class='post-body'>
                            <a href=''>
                                <h3>
                                    {$post_array['title']}
                                </h3>
                            </a>
                            <div class='post-content'>
                                {$post_array['summary']}
                            </div>
                        </div>
                    </div>
                    <div class='post-footer'>
                    </div>
                </div>";
            endforeach;
        }

        return $posts;
        // June 7, 2022
        // Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
    }
    public function load_searched_posts($search, $orderBy='id', $direction='DESC', $limit=null, $post_status='public') {
        $posts_array = $this->get_search_posts($search);
        
        $posts = "";
        if(count($posts_array) > 0) {
            

            foreach($posts_array as $post_array):
                $posts .= "
                <div class='post post-summary'>
                    <div class='thumbnail'>
                        <a href=''>
                            <img src='./img/post/{$post_array['thumbnail']}' alt=''>
                        </a>
                    </div>
                    <div class='post-main'>
                        <div class='post-body'>
                            <a href=''>
                                <h3>
                                    {$post_array['title']}
                                </h3>
                            </a>
                            <div class='post-content'>
                                {$post_array['summary']}
                            </div>
                        </div>
                    </div>
                    <div class='post-footer'>
                    </div>
                </div>";
            endforeach;
        }

        return $posts;
        // June 7, 2022
        // Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
    }
    public function load_btn() {
        return "<span class='btn load-more'>
            Load More
        </span>";
    }
}

?>