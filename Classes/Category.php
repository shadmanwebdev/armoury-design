<?php
/*
    create()
    update()
    delete()
*/
class Category extends Db {
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
        $cat_title = $_POST['cat_title'];
        if(isset($_POST['featured'])) {
            $featured = ($_POST['featured'] === 'true') ? 1 : 0;
        } else {
            $featured = 0;
        }
        $created_at = datetime_now();

        $mjy = convert_date($created_at, 'M j Y');
        
        $stmt = $this->con->prepare("INSERT INTO categories(cat_title, featured, created_at) VALUES (?,?,?)");
        $stmt->bind_param('sis', $cat_title, $featured, $created_at);
        if($stmt->execute()) {
            $id = $stmt->insert_id;
            if($featured == 1) {
                $star = "<i class='featured fa fa-star'></i>";
            } else {
                $star = "<i class='fa fa-star'></i>";
            }
            echo "<tr>
                <td>$cat_title</td>
                <td>$star</td>
                <td class='d-none d-md-table-cell'>$mjy</td>
                <td class='table-action'>
                    <a href='cat-edit?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/categories-handler?del=$id'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
            exit();
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    }
    public function get_categories() {
        $cats_array = array();
        $stmt = $this->con->prepare("SELECT * FROM categories ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $cat_array = array(
                        'id' => $row['id'],
                        'cat_title' => $row['cat_title'],
                        'featured' => $row['featured'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'create_mjy' => convert_date($row['created_at'], 'M j Y'),
                        'update_mjy' => convert_date($row['updated_at'], 'M j Y')
                    );
                    array_push($cats_array, $cat_array);          
                endforeach;
            } 
        }
        return $cats_array;
    }
    public function categories() {
        $cats_array = $this->get_categories();
        $cats = "";
        foreach($cats_array as $cat_array):
            if($cat_array['featured'] == 1) {
                $star = "<i class='featured fa fa-star'></i>";
            } else {
                $star = "<i class='fa fa-star'></i>";
            }
            $cats .= "<tr>
                <td>{$cat_array['cat_title']}</td>
                <td>$star</td>
                <td class='d-none d-md-table-cell'>{$cat_array['create_mjy']}</td>
                <td class='table-action'>
                    <a href='cat-edit?id={$cat_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                    <a onclick='return pop(this)' href='../controllers/categories-handler?del={$cat_array['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></a>
                </td>
            </tr>";
        endforeach;
        return $cats;
    }
    public function delete($id) {
        $stmt = $this->con->prepare("DELETE FROM categories WHERE id=?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        // return $status;
        header('location: ../admin/categories');
    }
}