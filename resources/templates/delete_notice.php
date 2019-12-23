<?php 

if(isset($_GET['delete_notice_id'])) {
    $query = query("DELETE FROM notices WHERE nid = " . escape_string($_GET['delete_notice_id']) . " ");
    confirm($query);

    set_message("Notice Deleted");
    echo "<script> window.location.assign('index.php?notices'); </script>";
} else {
    echo "<script> window.location.assign('index.php?notices'); </script>";
}
?>