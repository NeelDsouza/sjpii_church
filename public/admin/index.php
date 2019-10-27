<?php require_once("../../resources/config.php"); ?>
<?php require_once("../../resources/functions.php"); ?>
<?php include(TEMPLATES . "/admin_header.php");?>


<?php 
  if($_SERVER['REQUEST_URI'] == "/sjpii_church/public/admin/" || $_SERVER['REQUEST_URI'] == "/sjpii_church/public/admin/index.php")  {
    include(TEMPLATES . "/dashboard.php");
  } 
  else if(isset($_GET['add_event'])){
    include(TEMPLATES . "/add_event.php");
  } 
  else if(isset($_GET['edit_event'])){
    include(TEMPLATES . "/edit_event.php");
  } 
  else if(isset($_GET['events'])){
    include(TEMPLATES . "/events.php");
  } 
  else if(isset($_GET['gallary'])){
    include(TEMPLATES . "/gallary.php");
  }
  else if(isset($_GET['delete_event_id'])){
    include(TEMPLATES . "/delete_event.php");
  }
  else {
    // include(TEMPLATES . "/404.html");  
  }
?>

        

<?php include(TEMPLATES . "/admin_footer.php");?>