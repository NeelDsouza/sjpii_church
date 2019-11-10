<?php
require_once("config.php");

class Controller
{
    function __construct() {
        $this->processMobileVerification();
    }
    function processMobileVerification()
    {
        switch (escape_string($_POST["action"]) ){
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
            
        
        }
    }
}
$controller = new Controller();
?>