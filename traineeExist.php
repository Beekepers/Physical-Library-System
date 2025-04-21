<?php
ob_start();
require_once 'core/init.php';

$studentID = $_POST['studentID'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];

$trainees = new Trainees();

$check = $trainees->check_if_exists($studentID,$fname,$mname,$lname);
	if ($check) { 
		if ($trainees->data()->registered == 0){?>
			<html lang="en">
			  <head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>SDSSU - Cantilan Campus</title>

				<!-- Bootstrap -->
				<link href="styles/user/css/bootstrap.min.css" rel="stylesheet">
				<link href="styles/user/css/bootstrapValidator.min.css" rel="stylesheet">
				<!-- Bootstrap Validator CSS -->
				<link href="styles/user/css/formValidation.css" rel="stylesheet">
				<script src="styles/user/js/jquery-1.7.1.min.js"></script>
				<script type="text/javascript">
					$(document).ready(function () {
					 $("#username").blur(function () {
					 var username = $(this).val();
					 if (username == '') {
							$("#userAvailable").html("");
						 }else{
							$.ajax({
							  url: "usernameValidation.php?uname="+username
							}).done(function( data ) {
							  $("#userAvailable").html(data);
							});   
						  } 
					   });
					 });
				</script>
			  </head>
			<body>
			<div class="row justify-content-center">
			
				<div class="col-md-6 col-lg-6 p-b-80">
					<div class="tab01-head how2 how2-cl2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
					<h3 class="f1-m-2 cl13 tab01-title">
						Register Now!
					</h3>
					</div><hr>
					<div class="p-r-10 p-r-0-sr991">
						<div class="alert alert-success">
                            <i class="glyphicon glyphicon-ok"></i> You do exist as SDSSU OJT Student. Please continue filling up your Login information to complete your registration.
                         </div>
						<form method="post" id="register" action="trainee_register.php">
							<div class="form-group">
								<label class="control-label" for="username">Username <font color="#EC0003">*</font></label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Your desired username." >
								<span id="userAvailable"></span>
							</div>
							<div class="form-group">
								<label class="control-label" for="password">Password <font color="#EC0003">*</font></label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Your desired password." >
							</div>
							<div class="form-group">
								<label class="control-label" for="confirmpassword">Confirm Password <font color="#EC0003">*</font></label>
								<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" >
							</div>
							
							<center>
							<input type="hidden" name="login_id" value="<?php echo $trainees->data()->id; ?>">
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<button type="submit" class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-18 m-t-20">
								Register Your Account Now!
							</button>
							</center>
						</form>
					</div>
				</div>
			</div>
			<!-- jQuery google CDN Library -->
			<script src="styles/user/js/jquery.min.js"></script> 
			<!-- bootstrap js file -->
			<script src="styles/user/js/bootstrap.min.js"></script> 
			<!-- Bootstrap Validator JS -->
			<script src="styles/user/js/bootstrapValidator.min.js"></script> 
			<!-- Bootstrap Validator JS -->
			<script src="styles/user/js/formValidation.js"></script>
			<script src="styles/user/js/framework/bootstrap.js"></script>
			<script type="text/javascript">
			$(document).ready(function() {
				$('#register')
					.formValidation({
						framework: 'bootstrap',
						fields: {
							username : {
								message : "This field is required",
								validators : {
									notEmpty :{
									},
									stringLength :{
										min : 6,
										max : 35,
										message : "Username must be beetween 6 and 35 characters long"
									}	
								}
							},
							password : {
								message : "This field is required",
								validators : {
									notEmpty :{
									},
									stringLength :{
										min : 6,
										max : 20,
										message : "Username must be beetween 6 and 20 characters long"
									},
									different :{
										field : "username",
										message : "Your password and username should be different"
									}
								}
							},
							confirmpassword : {
								message : "This field is required",
								validators : {
									notEmpty :{
									},
									stringLength :{
										min : 6,
										max : 20,
										message : "Username must be beetween 6 and 20 characters long"
									},
									identical: {
										field: 'password',
										message: 'This must be the same as the password'
									}
								}
							},
						}
					})
			});
			</script>
			</body>
			</html>
		<?php }else{ ?>
			<script>
				document.getElementById('validate').innerHTML = "This student has already an account";
		</script>
		<?php }?>
	<?php }else{ ?>
	<script>
			document.getElementById('validate').innerHTML = "You don't exist as OJT Student.";
	</script>
	<?php }
	ob_end_flush();?>
	
