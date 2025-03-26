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
class Quote extends Db {
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
    public function get_quote($qid) {
        $stmt = $this->con->prepare("SELECT * FROM quotes WHERE id=?");
        $stmt->bind_param('i', $qid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $date = new DateTime($row['created_at'], new DateTimeZone('Europe/Dublin') );
            $MjYDate = $date->format("M j, Y");
            $time = $date->format("H:i:s");
            
            $quote_array = array(
                "id" => $row['id'],
                "fname" => $row["fname"],
                "lname" => $row["lname"],
                "email" => $row["email"],
                "phone" => $row["phone"],
                "pitch" => $row['pitch'],
                "key_val" => $row['key_val'],
                "future" => $row['future'],
                "competitors" => $row['competitors'],
                "diff" => $row['diff'],
                "goals" => $row['goals'],
                "defsuccess" => $row['defsuccess'],
                "avoidfail" => $row['avoidfail'],
                "leastfavsites" => $row['leastfavsites'],
                "audience" => $row['audience'],
                "curaudience" => $row['curaudience'],
                "information" => $row['information'],
                "website_url" => $row['website_url'],
                "qualities" => $row['qualities'],
                "tochange" => $row['tochange'],
                "deadline_budget" => $row['deadline_budget'],
                "features" => $row['features'],
                "mjy" => $MjYDate,
                "time" => $time
            ); 
        endforeach;
        $stmt->close();

        return $quote_array;
    }
    public function get_quotes() {
        $quotes_array = array();
        $stmt = $this->con->prepare("SELECT * FROM quotes ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $date = new DateTime($row['created_at'], new DateTimeZone('Europe/Dublin') );
            $MjYDate = $date->format("M j, Y");
            $time = $date->format("H:i:s");
            
            $quote_array = array(
                "id" => $row['id'],
                "fname" => $row["fname"],
                "lname" => $row["lname"],
                "email" => $row["email"],
                "phone" => $row["phone"],
                "pitch" => $row['pitch'],
                "key_val" => $row['key_val'],
                "future" => $row['future'],
                "competitors" => $row['competitors'],
                "diff" => $row['diff'],
                "goals" => $row['goals'],
                "defsuccess" => $row['defsuccess'],
                "avoidfail" => $row['avoidfail'],
                "leastfavsites" => $row['leastfavsites'],
                "audience" => $row['audience'],
                "curaudience" => $row['curaudience'],
                "information" => $row['information'],
                "website_url" => $row['website_url'],
                "qualities" => $row['qualities'],
                "tochange" => $row['tochange'],
                "features" => $row['features'],
                "deadline_budget" => $row['deadline_budget'],
                "mjy" => $MjYDate,
                "time" => $time
            ); 
            array_push($quotes_array, $quote_array); 
        endforeach;
        $stmt->close();

        return $quotes_array;
    }
    public function quotes_admin() {
        $quotes = "";
        $quotes_array = $this->get_quotes();

        foreach($quotes_array as $quote_array):
            $quotes .= "<tr class='clickable-row' data-href='./quote?qid={$quote_array['id']}' style='cursor:pointer;'>
                <td>
                    {$quote_array['fname']} {$quote_array['lname']}
                </td>
                <td>{$quote_array['phone']}</td>
                <td>{$quote_array['mjy']}</td>
            </tr>";
        endforeach;

        return $quotes;
    }
    public function create() {  
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $pitch = $_POST['pitch'];
        $key_val = $_POST['key_val'];
        $future = $_POST['future'];
        $competitors = $_POST['competitors'];
        $diff = $_POST['diff'];
        // var_dump(pitch, key_val, future, competitors, diff);
        
        $goals = $_POST['goals'];
        $defsuccess = $_POST['defsuccess'];
        $avoidfail = $_POST['avoidfail'];
        $leastfavsites = $_POST['leastfavsites'];
        // var_dump(goals, defsuccess, avoidfail, leastfavsites);
        
        $audience = $_POST['audience'];
        $curaudience = $_POST['curaudience'];
        $information = $_POST['information'];
        // var_dump(audience, curaudience, information);
        
        $website_url = $_POST['website_url'];
        $qualities = $_POST['qualities'];
        $tochange = $_POST['tochange'];
        $deadline_budget = $_POST['deadline_budget']; 
        // var_dump(website_url, qualities, tochange, deadline_budget);

        
        $menu = isset($_POST["menu"]) ? $_POST["menu"] : '0';
        $responsive = isset($_POST["responsive"]) ? $_POST["responsive"] : '0';
        $booking = isset($_POST["booking"]) ? $_POST["booking"] : '0';
        $blog = isset($_POST["blog"]) ? $_POST["blog"] : '0';
        $video = isset($_POST["video"]) ? $_POST["video"] : '0';
        $chat = isset($_POST["chat"]) ? $_POST["chat"] : '0';
        $social_media = isset($_POST["social_media"]) ? $_POST["social_media"] : '0';
        $contact_form = isset($_POST["contact_form"]) ? $_POST["contact_form"] : '0';
        $other = isset($_POST["other"]) ? $_POST["other"] : '0';
        $photo_galleries = isset($_POST["photo_galleries"]) ? $_POST["photo_galleries"] : '0';
        $open_hours = isset($_POST["open_hours"]) ? $_POST["open_hours"] : '0';

        $features = array(
            'menu' => $menu,
            'responsive' => $responsive,
            'booking' => $booking,
            'blog' => $blog,
            'video' => $video,
            'chat' => $chat,
            'social_media' => $social_media,
            'contact_form' => $contact_form,
            'other' => $other,
            'photo_galleries' => $photo_galleries,
            'open_hours' => $open_hours
        );

        $features = json_encode($features, true);
        $created_at = datetime_now();

        $stmt = $this->con->prepare("INSERT INTO quotes(fname, lname, email, phone, pitch, key_val, future, competitors, diff, goals, defsuccess, avoidfail, leastfavsites, audience, curaudience, information, website_url, qualities, tochange, deadline_budget, features, created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssssssssssssssssssss', $fname, $lname, $email, $phone, $pitch, $key_val, $future, $competitors, $diff, $goals, $defsuccess, $avoidfail, $leastfavsites, $audience, $curaudience, $information, $website_url, $qualities, $tochange, $deadline_budget, $features, $created_at);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        echo $status;
    }
    public function quote_admin($qid) {
        $quotes = "";
        $quote_array = $this->get_quote($qid);
        $features_json = json_decode($quote_array['features'], true);
        // var_dump($features_json);

        $features = "";
        if($features_json['menu'] == '1') {
            $features .= 'Menu, ';
        }
        if($features_json['responsive'] == '1') {
            $features .= 'Responsive, ';
        }
        if($features_json['booking'] == '1') {
            $features .= 'Booking, ';
        }
        if($features_json['blog'] == '1') {
            $features .= 'Blog, ';
        }
        if($features_json['video'] == '1') {
            $features .= 'Video, ';
        }
        if($features_json['chat'] == '1') {
            $features .= 'Chat, ';
        }
        if($features_json['social_media'] == '1') {
            $features .= 'Social media, ';
        }
        if($features_json['contact_form'] == '1') {
            $features .= 'Contact form, ';
        }
        if($features_json['other'] == '1') {
            $features .= 'Other, ';
        }
        if($features_json['photo_galleries'] == '1') {
            $features .= 'Photo galleries, ';
        }
        if($features_json['open_hours'] == '1') {
            $features .= 'Open hours, ';
        }

        if(strlen($features) > 0) {
            $features = rtrim($features, ", ");
        }

        $quote = "<div class='card'>
            <ul class='list-group list-group-flush'>
                <li class='list-group-item'>
                    <div><strong>Name</strong></div>
                    <div>{$quote_array['fname']} {$quote_array['lname']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Phone</strong></div>
                    <div>{$quote_array['phone']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Email</strong></div>
                    <div>{$quote_array['email']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Describe your business. What's your elevator pitch?</strong></div>
                    <div>{$quote_array['pitch']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What are your key values?</strong></div>
                    <div>{$quote_array['key_val']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What does your future look like?</strong></div>
                    <div>{$quote_array['future']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Who are your main competitors?</strong></div>
                    <div>{$quote_array['competitors']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What makes you different from your competitors?</strong></div>
                    <div>{$quote_array['diff']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What are your top 3 goals for this project? Describe your business. What's your elevator pitch?</strong></div>
                    <div>{$quote_array['goals']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What will define this project as successful?</strong></div>
                    <div>{$quote_array['defsuccess']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>How can we avoid failure?</strong></div>
                    <div>{$quote_array['avoidfail']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Do you have any least favorite websites?</strong></div>
                    <div>{$quote_array['leastfavsites']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Who is your target audience?</strong></div>
                    <div>{$quote_array['audience']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Is this your current audience? If not, how can we bridge the gap?</strong></div>
                    <div>{$quote_array['curaudience']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What information does your audience need to know from your website?</strong></div>
                    <div>{$quote_array['information']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Do you currently have a website? If so, please provide the URL.</strong></div>
                    <div>{$quote_array['website_url']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What are 3 things your site does well?</strong></div>
                    <div>{$quote_array['qualities']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What are 3 things you would like to change about your site?</strong></div>
                    <div>{$quote_array['tochange']}</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>Is there anything in particular you want on your site?</strong></div>
                    <div>$features</div>
                </li>
                <li class='list-group-item'>
                    <div><strong>What's your deadline and budget? How flexible are they?</strong></div>
                    <div>{$quote_array['deadline_budget']}</div>
                </li>
            </ul>
        </div>";

        return $quote;
    }

}
?>