<?php 

if(isset($_GET['delete_image_id'])) {
    $img_query = query("SELECT image from images WHERE imageid = ". escape_string($_GET['delete_image_id'])." ");
    $old_img = fetch_array($img_query);
    $query = query("DELETE FROM images WHERE imageid = " . escape_string($_GET['delete_image_id']) . " ");
    confirm($query);
    unlink(UPLOADS . DS . $old_img['image']);

    set_message("Image Deleted");
    echo "<script> window.location.assign('index.php?gallary'); </script>";
} else {
    echo "<script> window.location.assign('index.php?gallary'); </script>";
}
?>