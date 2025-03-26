<?php
/*
    create()
    update()
    delete()
*/
class ContactInfo extends Db {
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
    public function get_contact_info() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM contact_info WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $contact_info = array(
                "addr" => $row['addr'],
                "phone" => $row['phone'], 
                "email" => $row['email']
            );
        endforeach;
        $stmt->close();

        return $contact_info;
    }
    public function contact_info() { 
        $contact_info = $this->get_contact_info();
        return "<div class='col-lg-5'>
            <div class='contact-info-heading'>Contact Information</div>
            <ul class='list-unstyled mb-5'>
            <li class='mb-3'>
                <strong class='d-block mb-1'>Address</strong>
                <span>{$contact_info['addr']}</span>
            </li>
            <li class='mb-3'>
                <strong class='d-block mb-1'>Phone</strong>
                <span>{$contact_info['phone']}</span>
            </li>
            <li class='mb-3'>
                <strong class='d-block mb-1'>Email</strong>
                <span>{$contact_info['email']}</span>
            </li>
            </ul>
        </div>";
    }
    public function update() {  
        $id = 1;

        $addr = $_POST['addr'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        
        $stmt = $this->con->prepare("UPDATE contact_info SET addr=?, phone=?, email=? WHERE id=?");
        $stmt->bind_param('sssi', $addr, $phone, $email, $id);
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
    public function editForm() {
        $contact_info = $this->get_contact_info();
        return "<form autocomplete='off' id='edit_contact_form' class='edit_contact_form' method='POST'>     
            <div id='msg-response'></div>                  
            <input type='hidden' name='update_contact_info' id='update_contact_info' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Address</label>
                <input name='addr' id='addr' type='text' class='form-control' placeholder='Address' value='{$contact_info['addr']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Address</label>
                <input name='phone' id='phone' type='text' class='form-control' placeholder='Phone' value='{$contact_info['phone']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Address</label>
                <input name='email' id='email' type='text' class='form-control' placeholder='Email' value='{$contact_info['email']}'>
            </div>
            <span onclick='return update_contact_info(event)' type='submit' class='btn btn-primary'>Submit</span>
        </form>";
    }
}