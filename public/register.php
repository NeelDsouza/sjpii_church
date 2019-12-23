<?php require_once( "../resources/functions.php"); ?>
<?php include( TEMPLATES . "/header.php"); ?>
	<!-- header -->
<!---->
				<div class="register">
				<div class="container">
				<h2>Register</h2>
				<!-- <php login();?> -->
				 <div class="col-md-6  register-top-grid">
					<h3>Login Information</h3>
					<form action="" method="post" enctype="multipart/form-data">					
					<div>
						<span>Username</span>
						<input type="text" id="uname" name="uname"> 
					</div>
					<div>
						<span>Password</span>
						<input type="text" id="upassword" name="upassword"> 
					 </div>
					 <div id="admin_password" style="display: none">
						<span>Admin Password</span>
						<input type="text" id="uAdminPassword" name="uAdminPassword"> 
					 </div>
					 <div id="urole_radio" style="display: none">
					 <div style="display: flex;">
						 <span>Role</span>
						 <p style="margin-left: 10px">
						  <input type="radio" id="role1" name="urole" checked value="Council">
							<label for="role1">Council </label>
						</p>
						<p style="margin-left: 10px">
							<input type="radio" id="role2" name="urole" value="Youth">
							<label for="role2">Youth </label>
						</p>
						<p style="margin-left: 10px">
							<input type="radio" id="role3" name="urole" value="Advertiser">
							<label for="role3">Advertiser </label>
						</p>
					</div>
					</div>
						<div class="news-letter">
						 <label class="checkbox"><input type="checkbox" name="new_user">
						 <i> </i>Create New User</label>
						</div>
						<div class="alert alert-success" role="alert" style="padding: 10px; display: none">
						</div>
						<div class="alert alert-danger" role="alert" style="padding: 10px; display: none">
						</div>
					 <!--   <div><php display_message();?></div> -->
					   <div class="register-but" id="create_user" style="display: none">
						   <input type="submit" value="Sign Up" name="create_user">
						</div>
						<div class="register-but" id="login_user">
						   <input type="submit" value="Sign In" name="login_user">
						</div>
					</div>
				</form>
			<div class="clearfix"> </div>
		</div>	
</div>			
				<!-- footer -->
				<?php include(TEMPLATES . "/footer.php") ?>	
	<!-- footer -->
	<script>
		// Hide/Show new user functions
		$('input[type=checkbox][name=new_user]').change(function() {
			if (this.checked) {
				$('#create_user').show();
				$('#login_user').hide();
				$('#admin_password').show();
				$('#urole_radio').show();
			}
			else {
				$('#create_user').hide();
				$('#login_user').show();
				$('#admin_password').hide();
				$('#urole_radio').hide();
			}
		});

		$('#create_user input[type=submit]').click(function(e){
			e.preventDefault();
			var uname = $("#uname").val();
			var upassword = $("#upassword").val();
			var uAdminPassword = $("#uAdminPassword").val();
			var urole = $("input[name='urole']:checked"). val();
			var input = {
				uname: uname,
				upassword: upassword,
				uAdminPassword: uAdminPassword,
				urole: urole,
				action: "create_user"
			};
			if (uname != null && upassword != null && uAdminPassword != null && urole != null) {
				$.ajax({
				url: "../resources/ajax_functions.php",
				type: "POST",
				dataType: "json",
				data: input,
				success: function(response) {
					$(".alert-" + response.type).html(response.message);
					$(".alert-" + response.type).show();
					if(response.type === "success") {
						$(".alert-danger").hide();
						setTimeout(function(){ window.location.assign("register.php"); }, 1000);
					}
				},
				error: function(response) {
					$(".alert-" + response.type).html(response.message);
					$(".alert-" + response.type).show();
				}
				});
			} else {
				$(".alert-danger").html("Please fill up all the fields.");
				$(".alert-danger").show();
			}
		})

		$('#login_user input[type=submit]').click(function(e){
			e.preventDefault();
			var uname = $("#uname").val();
			var upassword = $("#upassword").val();
			var input = {
				uname: uname,
				upassword: upassword,
				action: "login_user"
			};
			if (uname != null && upassword != null) {
				$.ajax({
				url: "../resources/ajax_functions.php",
				type: "POST",
				dataType: "json",
				data: input,
				success: function(response) {
					$(".alert-" + response.type).html(response.message);
					$(".alert-" + response.type).show();
					if(response.type === "success") {
						$(".alert-danger").hide();
						// setTimeout(function(){ window.location.assign("register.php"); }, 1000);
					}
				},
				error: function(response) {
					$(".alert-" + response.type).html(response.message);
					$(".alert-" + response.type).show();
				}
				});
			} else {
				$(".alert-danger").html("Please fill up all the fields.");
				$(".alert-danger").show();
			}
		})

	</script>
</body>
</html>