<?php

class Testimonial extends Db {
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
        $fullname = $_POST['fullname'];
        $profession = $_POST['profession'];
        if(isset($_FILES['photo']['name'])) {
            $photo = add_img('photo');
        } else {
            $photo = "";
        }
        
        $stmt = $this->con->prepare("INSERT INTO testimonials(fullname, profession, photo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $profession, $photo);
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
    private function get_testimonials() {
        $testimonials = array();
        $stmt = $this->con->prepare("SELECT * FROM testimonials ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $testimonial = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'], 
                "profession" => $row['profession'], 
                "content" => $row['content'],
                "photo" => $row['photo']
            ); 
            array_push($testimonials, $testimonial); 
        endforeach;
        $stmt->close();

        return $testimonials;
    }
    public function testimonials() {
        $testimonials_array = $this->get_testimonials();
        $testimonials = "";
        if(count($testimonials_array) > 0) {
            foreach($testimonials_array as $testimonial_array):
                $testimonials .= "<div class='testimony px-5'>
                    <img src='./img/{$testimonial_array['photo']}' alt='Image' class='img-fluid'>
                    <h3>{$testimonial_array['fullname']}</h3>
                    <span class='sub-title'>{$testimonial_array['profession']}</span>
                    <p>&ldquo;<em>{$testimonial_array['content']}</em>&rdquo;</p>
                </div>";
            endforeach;
        } else {
            $testimonials = "No testimonials found";
        }
        return $testimonials;
    }
    private function get_testimonial($id) {
        $stmt = $this->con->prepare("SELECT * FROM testimonials WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $testimonial_array = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'], 
                "profession" => $row['profession'], 
                "content" => $row['content'],
                "photo" => $row['photo']
            ); 
        endforeach;
        $stmt->close();

        return $testimonial_array;
    }
    public function createForm() {
        return "
        <form autocomplete='off' id='testimonial_form' class='testimonial_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_testimonial' id='create_testimonial' value='true'>
            <div class='mb-3'>
                <label class='form-label' for='fullname'>Name: </label>
                <input type='text' name='fullname' id='fullname' class='form-control' placeholder='Name'>
            </div>
            <div class='mb-3'>
                <label for='profession' class='form-label'>Profession: </label>
                <input type='text' name='profession' id='profession' class='form-control' placeholder='Profession'>
            </div>
            <div class='mb-3'>
                <label for='content' class='form-label'>Content: </label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='6'></textarea>
            </div>
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Photo</span>
                <span id='image-name-1'></span>
            </span>  
            <div>
                <span style='margin-top: 10px;' onclick='return create_testimonial(event)' type='submit' class='btn btn-primary'>Submit</span>  
            </div>
        </form>";
    }
    public function updateForm($id) {
        $testimonial_array = $this->get_testimonial($id);

        if(!isset($_SESSION['v'])) { 
            $_SESSION['v'] = 1; 
            $v = $_SESSION['v'];
        } else {
            $v = floatval($_SESSION['v']) + 1;
            $_SESSION['v'] = $v;
        }

        if(!empty($testimonial_array['photo'])) {
            $img_str = "<div style='width:200px;height:auto;'>
                <img style='width:100%;height:100%;' src='../img/{$testimonial_array['photo']}?v=$v' alt=''>
            </div>
            <div>
                <a onclick='return pop(this)' title='delete' class='del-link' href='../controllers/testimonial-handler?id={$testimonial_array['id']}&type=photo&del={$testimonial_array['photo']}'>Delete</a>
            </div>";
        } else {
            $img_str = "";
        }
        return "
        <form autocomplete='off' id='testimonial_form' class='testimonial_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_testimonial' id='update_testimonial' value='true'>
            <input type='hidden' name='testimonial_id' id='testimonial_id' value='{$testimonial_array['id']}'>
            <div class='mb-3'>
                <label class='form-label' for='fullname'>Name: </label>
                <input type='text' name='fullname' id='fullname' value='{$testimonial_array['fullname']}' class='form-control' placeholder='Name'>
            </div>
            <div class='mb-3'>
                <label for='profession' class='form-label'>Profession: </label>
                <input type='text' name='profession' id='profession' value='{$testimonial_array['profession']}' class='form-control' placeholder='Profession'>
            </div>
            <div class='mb-3'>
                <label for='content' class='form-label'>Content: </label>
                <textarea name='content' id='content' class='form-control' placeholder='Content' rows='6'>{$testimonial_array['content']}</textarea>
            </div>
            $img_str
            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
            <span style='cursor:pointer;' onclick='return fireButton(event);'>
                <i class='fas fa-paperclip'></i>
                <span>Photo</span>
                <span id='image-name-1'></span>
            </span>
            <div>
                <span style='margin-top: 10px;' onclick='return update_testimonial(event)' type='submit' class='btn btn-primary'>Submit</span>  
            </div>
        </form>";
    }
    public function testimonials_admin() {
        $testimonials_array = $this->get_testimonials();
        $testimonials = "";
        foreach($testimonials_array as $testimonial_array):
            $testimonials .= "
            <tr>
                <td>
                    <div class='thumbnail testimonial-thumb'>
                        <img src='../img/{$testimonial_array['photo']}'>
                    </div>
                </td>
                <td>
                    {$testimonial_array['fullname']}
                </td>
                <td class='d-none d-md-table-cell'>
                    {$testimonial_array['profession']}
                </td>
                <td class='table-action'>
                    <a href='./testimonial-edit?id={$testimonial_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/testimonial-handler?del_testimonial={$testimonial_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
        endforeach;
        return $testimonials;
    }
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM testimonials WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/testimonials');
    }
    public function del_thumbnail($photo, $id) {
        unlink("../img/$photo");
        $stmt = $this->con->prepare("UPDATE testimonials SET photo=NULL WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header("location: ../admin/testimonial-edit?id=$id");
    }
    public function update($id) {  
        $fullname = $_POST['fullname'];
        $profession = $_POST['profession'];
        if(isset($_FILES['photo']['name'])) {
            $photo = add_img('photo');
        } else {
            $testimonial_array = $this->get_testimonial($id);
            if(!isset($photo) || empty($photo)) {
                $photo = $testimonial_array['photo'];
            }
        }
    
        $stmt = $this->con->prepare("UPDATE testimonials SET fullname=?, profession=?, photo=? WHERE id=?");
        $stmt->bind_param("sssi", $fullname, $profession, $photo, $id);
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