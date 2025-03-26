<?php
/*
    create()
    update()
    delete()
*/
class Project extends Db {
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
    public function get_project($id) {
        $stmt = $this->con->prepare("SELECT * FROM projects WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $project_array = array(
                        'id' => $row['id'],
                        'project_name' => $row['project_name'],
                        'sdate' => $row['sdate'],
                        'edate' => $row['edate'],
                        'project_status' => $row['project_status'],
                        'assignee' => $row['assignee']
                    );        
                endforeach;
            } 
        }
        return $project_array;
    }
    public function get_projects($limit=null) {
        $projects_array = array();
        if($limit == null) {
            $stmt = $this->con->prepare("SELECT * FROM projects ORDER BY id DESC");
        } else {
            $stmt = $this->con->prepare("SELECT * FROM projects ORDER BY id DESC LIMIT $limit");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $project_array = array(
                        'id' => $row['id'],
                        'project_name' => $row['project_name'],
                        'sdate' => $row['sdate'],
                        'edate' => $row['edate'],
                        'project_status' => $row['project_status'],
                        'assignee' => $row['assignee']
                    );
                    array_push($projects_array, $project_array);          
                endforeach;
            } 
        }
        return $projects_array;
    }
    public function projects($limit=null) {
        $projects_array = $this->get_projects();

        $projects = "";
        foreach($projects_array as $project_array): 
            if($project_array['project_status'] == 'Done') {
                $project_status = "<span class='badge bg-success'>Done</span>";
            } elseif($project_array['project_status'] == 'In progress') {
                $project_status = "<span class='badge bg-warning'>In progress</span>";
            } elseif($project_array['project_status'] == 'Cancelled') {
                $project_status = "<span class='badge bg-danger'>Cancelled</span>";
            }
            $projects .= "<tr class='clickable-row' data-href='./project-edit?id={$project_array['id']}' style='cursor:pointer;'>
                <td>{$project_array['project_name']}</td>
                <td class='d-none d-xl-table-cell'>{$project_array['sdate']}</td>
                <td class='d-none d-xl-table-cell'>{$project_array['edate']}</td>
                <td>$project_status</td>
                <td class='d-none d-md-table-cell'>{$project_array['assignee']}</td>
            </tr>";
        endforeach;

        echo $projects;
    }
    public function createForm() {
        return "<form autocomplete='off' id='project_form' class='project_form' method='POST' action='../controllers/project-handler.php'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='create_project' id='create_project' value='true'>
            <div class='mb-3'>
                <label class='form-label'>Name</label>
                <input name='project_name' id='project_name' type='text' class='form-control' placeholder='Name'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Start Date</label>
                <input class='form-control' type='text' name='start_date' id='start_date' placeholder='Start Date'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>End Date</label>
                <input class='form-control' type='text' name='end_date' id='end_date' placeholder='End Date'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Status</label>
                <select class='form-control' name='project_status' id='project_status'>
                    <option selected=''>Select Status</option>
                    <option>Done</option>
                    <option>Cancelled</option>
                    <option>In progress</option>
                </select>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Assignee</label>
                <input name='assignee' id='assignee' type='text' class='form-control' placeholder='Assignee'>
            </div>
            <span onclick='return create_project(event)' type='submit' class='btn btn-primary'>Submit</span>
        </form>";
        // onclick='return create_faq(event)'
    }
    public function editForm($id) {
        $project_array = $this->get_project($id);
        if($project_array['project_status'] == 'Done') {
            $statusOptions = "<option>Cancelled</option>
            <option>In progress</option>";
        } elseif ($project_array['project_status'] == 'Cancelled') {
            $statusOptions = "<option>Done</option>
            <option>In progress</option>";
        } elseif ($project_array['project_status'] == 'In progress') {
            $statusOptions = "<option>Done</option>
            <option>Cancelled</option>";
        }
        return "<form autocomplete='off' id='project_form' class='project_form' method='POST'>     
            <div id='msg-response'></div>                           
            <input type='hidden' name='update_project' id='update_project' value='true'>
            <input type='hidden' name='project_id' id='project_id' value='{$project_array['id']}'>
            <div class='mb-3'>
                <label class='form-label'>Name</label>
                <input name='project_name' id='project_name' type='text' class='form-control' placeholder='Name' value='{$project_array['project_name']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Start Date</label>
                <input class='form-control' type='text' name='start_date' id='start_date' placeholder='Start Date' value='{$project_array['sdate']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>End Date</label>
                <input class='form-control' type='text' name='end_date' id='end_date' placeholder='End Date' value='{$project_array['edate']}'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Status</label>
                <select class='form-control' name='status' id='project_status'>
                    <option selected=''>{$project_array['project_status']}</option>
                    $statusOptions
                </select>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Assignee</label>
                <input name='assignee' id='assignee' type='text' class='form-control' placeholder='Assignee' value='{$project_array['assignee']}'>
            </div>
            <span onclick='return update_project(event)' type='submit' class='btn btn-primary'>Submit</span>
            <a onclick='return pop(this)' href='../controllers/project-handler?del_project={$project_array['id']}' class='btn btn-danger'>Delete</a>
        </form>";
    }
    public function create() {
        $project_name = $_POST['project_name'];

        $sdate = $_POST['start_date'];
        $edate = $_POST['end_date'];
        $project_status = $_POST['project_status'];
        $assignee = $_POST['assignee'];

        
        $stmt = $this->con->prepare("INSERT INTO projects(project_name, sdate, edate, project_status, assignee) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $project_name, $sdate, $edate, $project_status, $assignee);
        
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
        $project_name = $_POST['project_name'];

        $sdate = $_POST['start_date'];
        $edate = $_POST['end_date'];
        $project_status = $_POST['project_status'];
        $assignee = $_POST['assignee'];

        // var_dump($project_name, $sdate, $edate, $project_status, $assignee);
        
        $stmt = $this->con->prepare("UPDATE projects SET project_name=?, sdate=?, edate=?, project_status=?, assignee=? WHERE id=?");
        $stmt->bind_param('sssssi', $project_name, $sdate, $edate, $project_status, $assignee, $id);
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
        $stmt = $this->con->prepare("DELETE FROM projects WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/projects');
    }
}