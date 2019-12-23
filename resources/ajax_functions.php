<?php
require_once("config.php");

class Controller
{
    function __construct(){
        $this->ajaxFunctionCalls();
    }
    function ajaxFunctionCalls()
    {
        switch (escape_string($_POST["action"]) ){
            case "create_user":
                $uname = escape_string($_POST['uname']);
                $query = query("SELECT uname FROM users WHERE uname = '{$uname}'");
                confirm($query);
                $rows = mysqli_num_rows($query);
                if($rows > 0){
                    echo json_encode(array("type"=>"danger", "message"=>"Username already present."));
                    // set_message("Username already present");
                } else {
                    $uAdminPassword= escape_string($_POST['uAdminPassword']);
                    $query = query("SELECT upassword FROM users WHERE userid = 1");
                    confirm($query);
                
                    $row = fetch_array($query);
                    if($row['upassword'] === $uAdminPassword){
                        $upassword = escape_string($_POST['upassword']);
                        $urole= escape_string($_POST['urole']);
                        $query = query("INSERT INTO users(uname, upassword, urole) VALUES ('{$uname}','{$upassword}','{$urole}')");
                        confirm($query);

                        echo json_encode(array("type"=>"success", "message"=>"Username ID created. Please Login."));
                    } else {
                        echo json_encode(array("type"=>"danger", "message"=>"Invalid Admin Password."));
                    }
                }
                break;
            case "login_user":
                echo $_POST['uname'];
                $uname= escape_string($_POST['uname']);
                $upassword= escape_string($_POST['upassword']);
                $query= query("SELECT * FROM users WHERE uname = '{$uname}' AND upassword = '{$upassword}'");
                confirm($query);
                $rows= mysqli_num_rows($query);
                if($rows == 0){
                    echo json_encode(array("type"=>"danger", "message"=>"Invalid Credentials."));
                    // set_message("Username already present");
                } else {
                    echo json_encode(array("type"=>"success", "message"=>"Logged in successfully."));
                }
                break;
            case "add_image" : 
                // $filename = escape_string($_FILES['file']['name']);
                $title = "Gallary Preview";
                $image_temp_location= escape_string($_FILES['file']['tmp_name']);
                $extension = explode("/", $_FILES['file']['type']);
                $image_name = "gallary-" . rand(0000,9999) . "." . $extension[1];
                if(move_uploaded_file($_FILES['file']['tmp_name']  , UPLOADS . DS . $image_name)){
                    $query = query("INSERT INTO images(title, image) VALUES ('{$title}','{$image_name}')");
                    confirm($query);
                }
                break;
            case "add_form" : 
                // $filename = escape_string($_FILES['file']['name']);
                $title = escape_string($_POST['title']);
                $src = escape_string($_POST['src']);
                $query = query("INSERT INTO forms(title, src) VALUES ('{$title}','{$src}')");
                confirm($query);
                break;
            case "add_notice" : 
                // $filename = escape_string($_FILES['file']['name']);
                $notice = escape_string($_POST['notice']);
                $expdate = escape_string($_POST['expdate']);
                $query = query("INSERT INTO notices(notice, expdate) VALUES ('{$notice}','{$expdate}')");
                confirm($query);
                break;
        }
    }
}
$controller = new Controller();
?>