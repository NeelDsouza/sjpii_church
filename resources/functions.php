<?php
require_once("config.php");

function add_message(){
  if(isset($_POST['add_message'])) {
    $mname      = escape_string($_POST['mname']);
    $memail     = escape_string($_POST['memail']);
    $mmessage   = escape_string($_POST['mmessage']);
    $msubject   = escape_string($_POST['msubject']);
    
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
        <a href="images/{$row['image']}" class="swipebox"  title="{$row['title']}"> <img src="images/{$row['image']}" class="img-responsive" alt="{$row['title']}"><span class="zoom-icon"></span> </a>
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
									<img src="images/{$row['evposter']}" class="img-responsive" alt="{$row['evname']}"/>
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
        <img src="images/{$row['evposter']}" class="img-responsive" alt="{$row['evname']}"/>
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
    $cname      = escape_string($_POST['cname']);
    $cmobile     = escape_string($_POST['cmobile']);
    $ccomment   = escape_string($_POST['ccomment']);
    $cdate   = escape_string($_POST['cdate']);
    
    $query = query("INSERT INTO comments (cname, cmobile, ccomment, cdate, eventid) VALUES ('{$cname}','{$cmobile}','{$ccomment}','{$cdate}','{$eid}')");
    confirm($query);
    set_message("Commented successfully");
 
    echo "<script> window.location.assign('events.php?eventid={$eid}'); </script>";
  }
}


?>