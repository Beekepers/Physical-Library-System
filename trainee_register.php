<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if($user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'unique' => 'userlogin'
            )
        ));
		
		if ($validate->passed()) {
			
			$login_id = uniqid();
			
            try {
				$user = new UserLogin();
                $user->create(array(
					'permission' => 9,
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password')),
                    'joined' => date('Y-m-d H:i:s'),
					'login_id' => $login_id,
					'fname' => '',
					'lname' => '',
					'avatar' => '',
					'current_session' => 0,
					'online' => 0,
                ));
				
				$trainee = new Trainees();
                $trainee->update(array(
					'registered' => 1,
					'login_id' => $login_id,
                ), Input::get('login_id'));

                Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now <a href="login.php">login</a>.');
                Redirect::to('trainee_register.php');
            } catch(Exception $e) {
                $error;
            }
			
		}else{
			foreach ($validate->errors() as $error) {
				Session::flash('Error', $error);
				Redirect::to('trainee_register.php');
            }
		}
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			
			<?php include 'includes/top-header.php'; ?>
			<!--  -->
			<?php include 'includes/wrap-main-nav.php'; ?>	
		</div>
	</header>
	<!-- Breadcrumb -->
	<div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="index.html" class="breadcrumb-item f1-s-3 cl9">
					Home 
				</a>
				<span class="breadcrumb-item f1-s-3 cl9">
					Register As OJT Trainee
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2" style="text-align:center">
			Register As OJT Trainee
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-12 ">
						<form method="post" >
								<?php if(Session::exists('home')){?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-check"></i> &nbsp;<?php echo Session::flash('home'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('Error')) { ?>
										<div class="alert alert-danger">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Error'); ?>
										</div>
								<?php }?>
							<div class="row">
								<div class="col-md-3 col-lg-3">
									<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="studentID" id="studentID" placeholder="Enter Student ID*" required>
								</div>
								<div class="col-md-3 col-lg-3">
									<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="fname" id="fname" placeholder="Enter Firstname*" required>
								</div>
								<div class="col-md-3 col-lg-3">
									<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="mname" id="mname" placeholder="Enter Middle Name*" required>
								</div>
								<div class="col-md-3 col-lg-3">
									<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="lname" id="lname" placeholder="Enter Lastname*" required>
								</div>
								<input type="hidden">
							</div>
							<div>
								<span id="validate" style="color:red"></span>
							</div>
							<button type="button" class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-20" onclick="checkname();">
								Check if you Exist as OJT Trainee
							</button>
							<hr>
							<span id="status">
							</span>
						</form>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Footer -->
	<?php include 'includes/footer.html'; ?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>

	<script>
	function checkname(){
		var studentID=document.getElementById( "studentID" ).value;	
		var fname=document.getElementById( "fname" ).value;	
		var mname=document.getElementById( "mname" ).value;	
		var lname=document.getElementById( "lname" ).value;	
		var validate = "Please Fill up all Fields.";	
		if(studentID && fname && mname && lname){
			$.ajax({
				type: 'post',
				url: 'traineeExist.php',
				data: {
					studentID:studentID,
					fname:fname,
					mname:mname,
					lname:lname
				},
				success: function (response) {
					$('#status').html(response);
					if(response=="OK"){
						return true;	
					}else{	
						return false;	
					}
				}
			});
			document.getElementById('validate').innerHTML = '';
		}else{
			document.getElementById('validate').innerHTML = validate;
			return false;
		}
	}	
	</script>
	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>