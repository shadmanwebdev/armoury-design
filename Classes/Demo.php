<?php

class Demo extends Db {
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
    public function create() {  
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $link = $_POST['link'];
        $thumbnail = add_img('image');
        
        $stmt = $this->con->prepare("INSERT INTO demos(title, tags, link, thumbnail) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $tags, $link, $thumbnail);
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
    private function get_demos() {
        $demos = array();
        $stmt = $this->con->prepare("SELECT * FROM demos ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $demo = array(
                "id" => $row['id'],
                "title" => $row['title'], 
                "tags" => $row['tags'], 
                "link" => $row['link'],
                "thumbnail" => $row['thumbnail']
            ); 
            array_push($demos, $demo); 
        endforeach;
        $stmt->close();

        return $demos;
    }
    public function demos() {
        $demos_array = $this->get_demos();
        $demos = "";
        if(count($demos_array) > 0) {


            foreach($demos_array as $demo_array):
                $tagsArr = explode(',', $demo_array['tags']);

                if(count($tagsArr)) {
                    $tagsStr = "";
                    foreach($tagsArr as $tag):
                        $tagsStr .= "$tag /";
                    endforeach;
                    if(strlen($tagsStr) > 0) {
                        $tagsStr = rtrim($tagsStr, "/");
                    }
                }

                $demos .= "<div class='mix flex-item web webd dmedia support'>
                    <div class='single-img'>
                        <img src='./img/{$demo_array['thumbnail']}' alt='Image'>
                        <div class='opacity'>
                            <div class='border-shape'>
                                <div>
                                    <div>
                                        <h6><a href='{$demo_array['link']}'>{$demo_array['title']}</a></h6>
                                        <ul>
                                            <li>$tagsStr</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            endforeach;
        } else {
            $demos = "No demos found";
        }
        return $demos;
    }
    private function get_demo($id) {
        $stmt = $this->con->prepare("SELECT * FROM demos WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $demo_array = array(
                "id" => $row['id'],
                "title" => $row['title'], 
                "tags" => $row['tags'], 
                "link" => $row['link'],
                "thumbnail" => $row['thumbnail']
            ); 
        endforeach;
        $stmt->close();

        return $demo_array;
    }
    public function createForm() {
        return "
        <form autocomplete='off' id='demo_form' class='demo_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_demo' id='create_demo' value='true'>
            <div class='mb-3'>
                <label class='form-label' for='title'>Title: </label>
                <input type='text' name='title' id='title' class='form-control' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label for='tags' class='form-label'>Tags: </label>
                <input type='text' name='tags' id='tags' class='form-control' placeholder='Tags'>
            </div>
            <div class='mb-3'>
                <label for='link' class='form-label'>Link: </label>
                <input type='text' name='link' id='link' class='form-control' placeholder='Link'>
            </div>
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Thumbnail</span>
                <span id='image-name-1'></span>
            </span>  
            <div>
                <span style='margin-top: 10px;' onclick='return create_demo(event)' type='submit' class='btn btn-primary'>Submit</span>  
            </div>
        </form>";
    }
    public function updateForm($id) {
        $demo_array = $this->get_demo($id);

        if(!isset($_SESSION['v'])) { 
            $_SESSION['v'] = 1; 
            $v = $_SESSION['v'];
        } else {
            $v = floatval($_SESSION['v']) + .1;
            $_SESSION['v'] = $v;
        }

        if(!empty($demo_array['thumbnail'])) {
            $img_str = "<div style='width:200px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$demo_array['thumbnail']}?v=$v' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/demo-handler?id={$demo_array['id']}&type=thumbnail&del={$demo_array['thumbnail']}'>Delete</a>
            </div>";
        } else {
            $img_str = "";
        }
        return "
        <form autocomplete='off' id='demo_form' class='demo_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_demo' id='update_demo' value='true'>
            <input type='hidden' name='demo_id' id='demo_id' value='{$demo_array['id']}'>
            <div class='mb-3'>
                <label class='form-label' for='title'>Title: </label>
                <input type='text' name='title' id='title' value='{$demo_array['title']}' class='form-control' placeholder='Title'>
            </div>
            <div class='mb-3'>
                <label for='tags' class='form-label'>Tags: </label>
                <input type='text' name='tags' id='tags' value='{$demo_array['tags']}' class='form-control' placeholder='Tags'>
            </div>
            <div class='mb-3'>
                <label for='link' class='form-label'>Link: </label>
                <input type='text' name='link' id='link' value='{$demo_array['link']}' class='form-control' placeholder='Link'>
            </div>
            $img_str
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Thumbnail</span>
                <span id='image-name-1'></span>
            </span>
            <div>
                <span style='margin-top: 10px;' onclick='return update_demo(event)' type='submit' class='btn btn-primary'>Submit</span>  
            </div>
        </form>";
    }
    public function demos_admin() {
        $demos_array = $this->get_demos();
        $demos = "";
        foreach($demos_array as $demo_array):
            $demos .= "
            <tr>
                <td>
                    <div class='thumbnail demo-thumb'>
                        <img src='../img/{$demo_array['thumbnail']}'>
                    </div>
                </td>
                <td>
                    {$demo_array['title']}
                </td>
                <td class='d-none d-md-table-cell'>
                    {$demo_array['tags']}
                </td>
                <td class='table-action'>
                    <a href='./demo-edit?id={$demo_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/demo-handler?del_demo={$demo_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
        endforeach;
        return $demos;
    }
    public function update($id) {  
        $demo_array = $this->get_demo($id);
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $link = $_POST['link'];
        if(isset($_FILES['image']['name'])) {
            $thumbnail = add_img('image');
        } else {
            $thumbnail = $demo_array['thumbnail'];
        }
        
        
        $stmt = $this->con->prepare("UPDATE demos SET title=?, tags=?, link=?, thumbnail=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $tags, $link, $thumbnail, $id);
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
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM demos WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/demos');
    }
    public function del_thumbnail($thumbnail, $id) {
        unlink("../img/$thumbnail");
        $stmt = $this->con->prepare("UPDATE demos SET thumbnail=NULL WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/demo-edit?id=$id");
    }
}