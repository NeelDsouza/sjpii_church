<?php require_once( "../resources/functions.php"); ?>
<?php include( TEMPLATES . "/header.php"); ?>
	<!-- header -->
	<!-- contact -->
	<div class="contact">
	<div class="container">
			<h2>contact us</h2>

					<div class="contact-head text-center">
						<p>Want to get in touch? We'd love to hear from you. Here's how you can reach us.</p>
					</div>		
					<!----- contact-grids ----->		
					<div class="contact-grids">
						<div class="col-md-5">
							<h3>Address</h3>
								<div class="address">
									<p>Missionaries of charity (Prerana Bhawan)</p> 
									<p>Mulshi Bhumkar Nagar Tathawade Pimpri-Chinchwad,
									<br>Pune, Maharashtra 411033.</p>
									<p>Telephone : +1 800 603 6035</p> 
									<p>E-mail : <a href="mailto:example@gmail.com">info@sjpiichurch.com</a></p>
								</div>
						</div>
						<div class="col-md-7">
							<div class="contact-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3781.249466476013!2d73.74252696485252!3d18.6078458740841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x679031398827fec3!2sMissionaries%20of%20charity%20(Prerana%20Bhawan)!5e0!3m2!1sen!2sin!4v1569738156825!5m2!1sen!2sin" width="600" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
								
							</div>
						</div>
							<div class="clearfix"> </div>
						<!----- contact-form ------>
						<?php add_message();?>
						<div class="contact-form">
						<form action="" method="post" enctype="multipart/form-data">
								<div class="contact-form-row">
									<div>
										<span>Name :</span>
										<input type="text" class="text"  name="mname" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
									</div>
									<div>
										<span>Email :</span>
										<input type="text" class="text"  name="memail" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
									</div>
									<div>
										<span>Subject :</span>
										<input type="text" class="text"  name="msubject" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="clearfix"> </div>
								<div class="contact-form-row2">
									<span>Message :</span>
									<textarea name="mmessage" > </textarea>
								</div>
								<input type="submit" name="add_message" value="send">
							</form>
						</div>
						<!----- contact-form ------>
					</div>
					<!----- contact-grids ----->
			
		</div>
	</div>
	<!-- contact -->		
	<!-- footer -->
	<?php include(TEMPLATES . "/footer.php") ?>	

	
	<!-- footer -->
</body>
</html>