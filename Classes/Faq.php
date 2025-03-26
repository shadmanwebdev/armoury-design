<?php
/*
    create()
    update()
    delete()
*/
class Faq extends Db {
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
    public function createForm() {
        return "<form autocomplete='off' id='faq_form' class='faq_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_faq' id='create_faq' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Question</label>
                <input name='question' id='question' type='text' class='form-control' placeholder='Question'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Answer</label>
                <textarea name='answer' id='answer' class='form-control' placeholder='Answer' rows='2'></textarea>
            </div>
            <span onclick='return create_faq(event)' type='submit' class='btn btn-primary'>Submit</span>
        </form>";
    }
    public function editForm($id) {
        $faq_array = $this->get_faq($id);
        return "<form autocomplete='off' id='faq_form' class='faq_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='faq_id' id='faq_id' value='{$faq_array['id']}'>
            <input type='hidden' name='update_faq' id='update_faq' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Question</label>
                <input name='question' id='question' type='text' class='form-control' placeholder='Question' value='{$faq_array['question']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Answer</label>
                <textarea name='answer' id='answer' class='form-control' placeholder='Answer' rows='2'>{$faq_array['answer']}</textarea>
            </div>
            <span onclick='return update_faq(event)' type='submit' class='btn btn-primary'>Submit</span>
        </form>";
    }
    public function create() {  
        $q = $_POST['question'];
        $a = $_POST['answer'];
        
        $stmt = $this->con->prepare("INSERT INTO faqs(question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $q, $a);
        
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
    public function update($id) {  
        $q = $_POST['question'];
        $a = $_POST['answer'];
        
        $stmt = $this->con->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
        $stmt->bind_param('ssi', $q, $a, $id);
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
    public function get_faq($id) {
        $stmt = $this->con->prepare("SELECT * FROM faqs WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $faq_array = array(
                        'id' => $row['id'],
                        'question' => $row['question'],
                        'answer' => $row['answer']
                    );        
                endforeach;
            } 
        }
        return $faq_array;
    }
    public function get_faqs() {
        $faqs_array = array();
        $stmt = $this->con->prepare("SELECT * FROM faqs ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $faq_array = array(
                        'id' => $row['id'],
                        'question' => $row['question'],
                        'answer' => $row['answer']
                    );
                    array_push($faqs_array, $faq_array);          
                endforeach;
            } 
        }
        return $faqs_array;
    }
    public function faqs() {
        $faqs_array = $this->get_faqs();
        $faqs = "";
        foreach($faqs_array as $faq_array):
            $faqs .= "<div class='col-md-6 mb-4'>
                <h5>{$faq_array['question']}</h5>
                <p class='text-muted'>
                    {$faq_array['answer']}
                </p>
            </div>";
        endforeach;
        return $faqs;
    }
    public function faqs_admin() {
        $faqs_array = $this->get_faqs();
        $faqs = "";
        foreach($faqs_array as $faq_array):
            $ans_summary = segment($faq_array['answer']);
            $ques_summary = segment($faq_array['question']);
            $faqs .= "<tr>
                <td>
                    $ques_summary
                </td>
                <td class='d-none d-md-table-cell'>
                    $ans_summary
                </td>
                <td class='table-action'>
                    <a href='./faq-edit?id={$faq_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/faq-handler?del_faq={$faq_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
        endforeach;
        return $faqs;
    }
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM faqs WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/faqs');
    }
}