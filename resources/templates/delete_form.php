<?php 

if(isset($_GET['delete_form_id'])) {
    $query = query("DELETE FROM forms WHERE formid = " . escape_string($_GET['delete_form_id']) . " ");
    confirm($query);

    set_message("Form Deleted");
    echo "<script> window.location.assign('index.php?forms'); </script>";
} else {
    echo "<script> window.location.assign('index.php?forms'); </script>";
}
?>