<?php 

if(isset($_GET['delete_event_id'])) {
    $query = query("DELETE FROM events WHERE eventid = " . escape_string($_GET['delete_event_id']) . " ");
    confirm($query);

    set_message("Event Deleted");
    echo "<script> window.location.assign('index.php?events'); </script>";
} else {
    echo "<script> window.location.assign('index.php?events'); </script>";
}
?>