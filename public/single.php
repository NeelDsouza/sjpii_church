<?php require_once( "../resources/functions.php"); ?>
<?php include( TEMPLATES . "/header.php"); ?>

<?php 
  if(isset($_GET['eventid'])) {
  $query = query("SELECT * FROM events WHERE eventid = " . escape_string($_GET['eventid']) . " ");
  confirm($query);

  while($row = fetch_array($query)) {
    $eventid           	= escape_string($row['eventid']);
    $evname           	= escape_string($row['evname']);
    $evposter           = escape_string($row['evposter']);
    $evbigdesc          = escape_string($row['evbigdesc']);
    $evstartdate        = escape_string($row['evstartdate']);
    $evenddate          = escape_string($row['evenddate']);
    $evorganiser        = escape_string($row['evorganiser']);
    $evvenue            = escape_string($row['evvenue']);
  }
//   update_profile();
  } else
  echo "<script> window.location.assign('./events.php'); </script>";

?>

	<!-- header -->
	<div class="container">
<div class="single-page-artical">
	<div class="artical-content">
		<h3><?php echo $evname ?></h3>
		<img class="img-responsive" src="images/<?php echo $evposter ?>" title="banner1">
		<p><?php echo $evbigdesc ?></p>
		</div>
		<div class="artical-links">
		<ul>
			<li><small> </small>Date: <span><?php echo $evstartdate ?></span> - <span><?php echo $evenddate ?></span></li>
			<li><a href="#"><small class="admin"> </small>Organiser: <span><?php echo $evorganiser ?></span></a></li>
			<li><a href="#"><small class="link"> </small>Venue: <span><?php echo $evvenue ?></span></a></li>
			<li><a href="#"><small class="no"> </small><span>No comments</span></a></li>
			<li><a href="events.php"><small class="posts"> </small><span>View other posts</span></a></li>
		</ul>
		</div>
		<div class="comment-grid-top">
  		<?php show_comments($eventid);?>
			
		</div>
		  						
		<div class="artical-commentbox">
		<h3>leave a comment</h3>
			<div class="table-form">
			<?php add_comment($eventid); ?>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="text" name="cname" class="textbox" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
				<input type="text" name="cmobile" class="textbox" value="Phone number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone number';}">
				<input type="text" name="cdate" hidden value="<?php echo date("Y-m-d") ?>">
				<textarea value="Message:" name="ccomment" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>	
			<input type="submit" name="add_comment" value="SEND">
			</form>
			
		</div>
		</div>
		
	</div>

</div>
	<!-- footer -->
	<?php include(TEMPLATES . "/footer.php") ?>	
	<!-- footer -->
</body>
</html>