<?php
require_once("config.php");

class Controller
{
    function __construct() {
        $this->ajaxFunctionCalls();
    }
    function ajaxFunctionCalls()
    {
        switch (escape_string($_POST["action"]) ){
            case "create_user":
                $uname      = escape_string($_POST['uname']);
                $query      = query("SELECT uname FROM users WHERE uname = '{$uname}'");
                confirm($query);
                $rows = mysqli_num_rows($query);
                if($rows > 0){
                    echo json_encode(array("type"=>"danger", "message"=>"Username already present."));
                    // set_message("Username already present");
                } else {
                    $uAdminPassword  = escape_string($_POST['uAdminPassword']);
                    $query = query("SELECT upassword FROM users WHERE userid = 1");
                    confirm($query);
                    
                    $row = fetch_array($query);
                    if($row['upassword'] === $uAdminPassword){
                        $upassword  = escape_string($_POST['upassword']);
                        $urole      = escape_string($_POST['urole']);
                        $query = query("INSERT INTO users(uname, upassword, urole) VALUES ('{$uname}','{$upassword}','{$urole}')");
                        confirm($query);

                        echo json_encode(array("type"=>"success", "message"=>"Username ID created. Please Login."));
                    } else {
                        echo json_encode(array("type"=>"danger", "message"=>"Invalid Admin Password."));
                    }

                }
                break;
            case "login_user":
                $uname      = escape_string($_POST['uname']);
                $upassword  = escape_string($_POST['upassword']);
                $query      = query("SELECT * FROM users WHERE uname = '{$uname}' AND upassword = '{$upassword}'");
                confirm($query);
                $rows = mysqli_num_rows($query);
                if($rows == 0){
                    echo json_encode(array("type"=>"danger", "message"=>"Invalid Credentials."));
                    // set_message("Username already present");
                } else {
                        echo json_encode(array("type"=>"success", "message"=>"Logged in successfully."));
                }
                break;
        }
    }
}
$controller = new Controller();
?>