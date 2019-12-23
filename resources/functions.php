<?php
require_once("config.php");

function add_message(){
	if(isset($_POST['add_message'])) {
	$mname = escape_string($_POST['mname']);
	$memail = escape_string($_POST['memail']);
	$mmessage = escape_string($_POST['mmessage']);
	$msubject = escape_string($_POST['msubject']);

	$query = query("INSERT INTO messages(mname, memail, mmessage, msubject) VALUES ('{$mname}','{$memail}','{$mmessage}','{$msubject}')");
	confirm($query);
	set_message("Message sent successfully");

	echo "<script> window.location.assign('index.php'); </script>";
	}
}

function get_images_in_gallary(){
	$query = query("SELECT * from images ORDER BY image");
	confirm($query);

	while($row = fetch_array($query)) {
	$image = <<<DELIMETER
	<div class="portfolio card mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="card" style="display: inline-block; opacity: 1;">
	<div class="portfolio-wrapper grid_box">		
		<a href="../resources/uploads/{$row['image']}" class="swipebox"  title="{$row['title']}"> <img src="../resources/uploads/{$row['image']}" class="img-responsive" alt="{$row['title']}"><span class="zoom-icon"></span> </a>
	</div>
	</div>
DELIMETER;
echo $image;
	}
}

function get_upcoming_events(){
	$query = query("SELECT * from events");
	confirm($query);
	$rows = mysqli_num_rows($query);
	if($rows>0){
	while($row = fetch_array($query)) {
	$event = <<<DELIMETER
	<div class="col-md-4 service_grid">
		<div class="view view-tenth">
			<a href="single.php?eventid={$row['eventid']}">
			  <div class="inner_content clearfix">
				<div class="product_image">
				<img src="../resources/uploads/{$row['evposter']}" class="img-responsive" alt="{$row['evname']}"/>
				<div class="mask" >
					<h4>{$row['evstartdate']} to {$row['evenddate']}</h4>
					<p>{$row['evshortdesc']}</p>
	                <div class="event_show_more">SHOW MORE</div>
				</div>
				</div>
				</div>
			</a> 
		  </div>
		<h4>{$row['evname']}</h4>
       	<p>{$row['evshortdesc']}</p>
    </div>
DELIMETER;
echo $event;
}
} else {
	echo "<p>No upcoming events.</p>";
}
}

function get_past_events(){
	$query = query("SELECT * from events");
	confirm($query);
	$rows = mysqli_num_rows($query);
	if($rows>0){
	while($row = fetch_array($query)) {
	$event = <<<DELIMETER
	<div class="col-md-4 grid_7">
	<div class="element">
	<div class="view view-tenth">
		<a href="single.php?eventid={$row['eventid']}">
		<div class="inner_content clearfix">
		<div class="product_image">
		<img src="../resources/uploads/{$row['evposter']}" class="img-responsive" alt="{$row['evname']}"/>
		<div class="mask" >
		<h4>{$row['evstartdate']} to {$row['evenddate']}</h4>
		<p>{$row['evshortdesc']}</p>
		<div class="event_show_more">SHOW MORE</div>
		</div>
		</div>
	</div>
	</a> 
	</div>
	<h4>{$row['evname']}</h4>
	<p>{$row['evshortdesc']}</p>
	</div>
  </div>
DELIMETER;
echo $event;
	}
} else {
	echo "<p>No past events.</p>";
}
}

function show_comments($eid){
	$query = query("SELECT * from comments WHERE eventid = '{$eid}'");
	confirm($query);
	$rows = mysqli_num_rows($query);
	if($rows>0){
	echo "<h3>{$rows} Responses</h3>";
	while($row = fetch_array($query)) {
	$event = <<<DELIMETER
	    <div class="comments-top-top">
	<div class="top-comment-left">
	<img class="img-responsive" src="images/co.png" alt="">
	</div>
	<div class="top-comment-right">
	<ul>
	<li><span class="left-at"><a href="#">{$row['cname']}</span></li>
	<li><span class="right-at">{$row['cdate']}</span></li>
	<li><a class="reply" href="#">REPLY</a></li>
	</ul>
	<p>{$row['ccomment']}</p>
	</div>
	<div class="clearfix"> </div>
	</div>
DELIMETER;
echo $event;
	}
} else {
	echo '<h3>No Response yet.</h3>';
}
}

function add_comment($eid){
	if(isset($_POST['add_comment'])) {
		$cname = escape_string($_POST['cname']);
		$cmobile = escape_string($_POST['cmobile']);
		$ccommentv= escape_string($_POST['ccomment']);
		$cdate = escape_string($_POST['cdate']);

		$query = query("INSERT INTO comments (cname, cmobile, ccomment, cdate, eventid) VALUES ('{$cname}','{$cmobile}','{$ccomment}','{$cdate}','{$eid}')");
		confirm($query);
		set_message("Commented successfully");

		echo "<script> window.location.assign('events.php?eventid={$eid}'); </script>";
	}
}

function add_event(){
	if(isset($_POST['add_event'])) {
		$evname = escape_string($_POST['evname']);
		$evshortdesc = escape_string($_POST['evshortdesc']);
		$evbigdesc = escape_string($_POST['evbigdesc']);
		$evstartdate = escape_string($_POST['evstartdate']);
		$evenddate = escape_string($_POST['evenddate']);
		$evvenue = escape_string($_POST['evvenue']);
		$evorganiser = escape_string($_POST['evorganiser']);
		$evposter = escape_string($_FILES['evposter']['name']);
		$image_temp_location = $_FILES['evposter']['tmp_name'];
		// $last_id = last_id("events");  ==== $last_id . "-" . 
		$extension = explode("/", $_FILES['evposter']['type']);
		$image_name = "Event-" . rand(00000,99999) . "." . $extension[1];
		move_uploaded_file($image_temp_location  , UPLOADS . DS . $image_name);

		$query = query("INSERT INTO events (evname, evposter, evshortdesc, evbigdesc, evstartdate, evenddate, evvenue, evorganiser) VALUES ('{$evname}','{$image_name}','{$evshortdesc}','{$evbigdesc}','{$evstartdate}','{$evenddate}','{$evvenue}','{$evorganiser}')");
		confirm($query);
		set_message("Event added successfully");

		echo "<script> window.location.assign('index.php?events'); </script>";
	}
}

function get_all_events(){
	$query = query("SELECT * from events");
	confirm($query);
	$rows = mysqli_num_rows($query);
	if($rows>0){
	while($row = fetch_array($query)) {
	$event = <<<DELIMETER
	<tr>
	<td>{$row['evname']}</td>
	<td>{$row['evstartdate']}</td>
	<td>{$row['evenddate']}</td>
	<td>
	<div class="text-center">
	<img class="img-fluid" style="width: 25rem;" src="../../resources/uploads/{$row['evposter']}" alt="Event Poster">
	</div>
	</td>
	<td>
	<a href="index.php?edit_event&eventid={$row['eventid']}" class="btn btn-warning btn-icon-split btn-sm">
	<span class="icon text-white-50">
		<i class="fas fa-edit"></i>
	</span>
	<span class="text">Edit</span> 
	</a>
	<a class="btn btn-danger btn-icon-split btn-sm" id="eventDeleteModal" href="" data-eventid={$row['eventid']} data-toggle="modal" data-target="#deleteModal">
	<span class="icon text-white-50">
		<i class="fas fa-trash"></i>
	</span>
	<span class="text">Delete</span>
	</a>
	</td>
	</tr>
DELIMETER;
echo $event;
	}
} else {
	echo "<p>No past events.</p>";
}
}

function edit_event($eventid){
	if(isset($_POST['edit_event'])) {
		$evname = escape_string($_POST['evname']);
		$evshortdesc = escape_string($_POST['evshortdesc']);
		$evbigdesc = escape_string($_POST['evbigdesc']);
		$evstartdate = escape_string($_POST['evstartdate']);
		$evenddate = escape_string($_POST['evenddate']);
		$evvenue = escape_string($_POST['evvenue']);
		$evorganiser = escape_string($_POST['evorganiser']);

		if($_FILES['evposter']['name'] !== ''){
			$evposter = escape_string($_FILES['evposter']['name']);
			$image_temp_location = $_FILES['evposter']['tmp_name'];
			// $last_id = last_id("events");  ==== $last_id . "-" . 
			$extension = explode("/", $_FILES['evposter']['type']);
			$image_name = "Event-" . rand(00000,99999) . "." . $extension[1];
			move_uploaded_file($image_temp_location  , UPLOADS . DS . $image_name);

			$img_query = query("SELECT evposter from events WHERE eventid = $eventid ");
			$old_img = fetch_array($img_query);
			unlink(UPLOADS . DS . $old_img['evposter']);
			
			$query = "UPDATE events SET ";
			$query.= "evname = '{$evname}',";
			$query.= "evposter = '{$image_name}',";
			$query.= "evshortdesc = '{$evshortdesc}',";
			$query.= "evbigdesc = '{$evbigdesc}',";
			$query.= "evstartdate = '{$evstartdate}',";
			$query.= "evenddate = '{$evenddate}',";
			$query.= "evvenue = '{$evvenue}',";
			$query.= "evorganiser = '{$evorganiser}'";
			$query.= "WHERE eventid = '{$eventid}'";
			confirm(query($query));
			set_message("Event Edited successfully");
		} 
		else {
			$query = "UPDATE events SET ";
			$query.= "evname = '{$evname}',";
			$query.= "evshortdesc = '{$evshortdesc}',";
			$query.= "evbigdesc = '{$evbigdesc}',";
			$query.= "evstartdate = '{$evstartdate}',";
			$query.= "evenddate = '{$evenddate}',";
			$query.= "evvenue = '{$evvenue}',";
			$query.= "evorganiser = '{$evorganiser}'";
			$query.= "WHERE eventid = '{$eventid}'";
			confirm(query($query));
			set_message("Event Edited successfully");
		}
		echo "<script> window.location.assign('index.php?events'); </script>";
	}
}

function get_all_images_in_admin(){
	$query = query("SELECT * from images");
	confirm($query);
	$rows = mysqli_num_rows($query);
	if($rows>0){
	while($row = fetch_array($query)) {
	$image = <<<DELIMETER
	<div class="card col-xl-4 col-md-6 mb-4" style="width: 18rem; padding: 0;">
		<img class="card-img-top" src="../../resources/uploads/{$row['image']}" alt="{$row['title']}">
		<a class="btn btn-danger btn-icon-split btn-sm" id="imageDeleteModal" href="" data-imageid={$row['imageid']} data-toggle="modal" data-target="#deleteModal">
		<span class="icon text-white-50">
			<i class="fas fa-trash"></i>
		</span>
		<span class="text">Delete</span>
		</a>
	</div>
DELIMETER;
echo $image;
	}
} else {
	echo "<p>No images found.</p>";
}
}

function get_forms(){
	$query = query("SELECT * from forms");
	confirm($query);

	while($row = fetch_array($query)) {
	$form = <<<DELIMETER
	<div class="portfolio">
		<h2>{$row['title']}</h2>
			<iframe src="{$row['src']}" width="100%" height="551" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
			
	  <div class="clearfix"></div>
	</div>
DELIMETER;
echo $form;
	}
}

function get_all_forms(){
	$query = query("SELECT * from forms");
	confirm($query);

	while($row = fetch_array($query)) {
	$form = <<<DELIMETER
	<div class="form-group row">
		<div class="col-sm-9 mb-2 mb-sm-0">
		<input type="text" class="form-control form-control-user" name="title" placeholder="Form Title" value="{$row['title']}">
		</div>
		<div class="col-sm-3 mb-1 mb-sm-0">
		<a href="index.php?delete_form_id={$row['formid']}"
			<button class="btn btn-danger btn-icon-split">
				<span class="icon text-white-50">
				<i class="fas fa-trash"></i>
				</span>
				<span class="text">Delete</span>
			</button>
		</a>
		</div>
	</div>
	<div class="form-group">
		<textarea class="form-control form-control-user" name="src" aria-label="With textarea" placeholder="Google Form iframe code">{$row['src']}</textarea>
	</div>
	<hr>
DELIMETER;
echo $form;
	}
}

function get_all_notices(){
	$query = query("SELECT * from notices");
	confirm($query);

	while($row = fetch_array($query)) {
	$notice = <<<DELIMETER
		<tr>
		<td>{$row['notice']}</td>
		<td>{$row['expdate']}</td>
		<td>
		<a href="index.php?delete_notice_id={$row['nid']}"
			<button id="deleteNoticeButton" class="btn btn-danger btn-sm btn-icon-split">
				<span class="icon text-white-50">
				<i class="fas fa-trash"></i>
				</span>
				<span class="text">Delete</span>
			</button>
		</a>
		</td>
		</tr>
DELIMETER;
echo $notice;
	}
}


?>