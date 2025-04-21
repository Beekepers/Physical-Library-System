	<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

if($user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
            $user = new UserLogin();
			$logindetails = new LoginDetails();
			
            $login = $user->login(Input::get('username'), Input::get('password'), Input::get('permission'));

            if($login) {
				try {
				$user->update(array(
					'online' => 1,
					), $user->data()->id);
				} catch(Exception $e) {
					$error;
				}
				$lastInsertId = $logindetails->insertUserLoginDetails($user->data()->id);
				$_SESSION['login_details_id'] = $lastInsertId;
				
				if($user->isAdmin()) {
                    Redirect::to('admin.php');
				}else{
				    Redirect::to('index.php');
				}
            } else {
				Session::flash('incorrectData', 'Incorrect username or password');
            }
    }
}
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
				<a href="index.php" class="breadcrumb-item f1-s-3 cl9">
					Home 
				</a>

				<span class="breadcrumb-item f1-s-3 cl9">
					Login
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2" style="text-align:center">
			LOGIN
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-6 p-b-80">
					<div class="p-r-10 p-r-0-sr991">
						<form method="post" action="">
								<?php if(Session::exists('login')){?>
									<div class="alert alert-info">
										<i class="glyphicon glyphicon-info-sign"></i> &nbsp;<?php echo Session::flash('login'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('LoginError')){?>
									<div class="alert alert-danger">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('LoginError'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('IncorrectUsername')){?>
									<div class="alert alert-danger">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('IncorrectUsername'); ?>
									</div>
								<?php }?>
								<?php if(Session::exists('IncorrectPass')){?>
									<div class="alert alert-danger">
										<i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('IncorrectPass'); ?>
									</div>
								<?php }?>
							<label style="font-size: 20px;padding-bottom:5px;" for="permission"> Login as: </label>
							<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="permission" id="permission" required>
								<option hidden value="">Select One</option>
								<?php
									$permission = DB:: getInstance()->query("SELECT * FROM groups");							
									foreach($permission->results() as $permission){
								?>
								<option value="<?php echo $permission->id?>"><?php echo ucwords($permission->name) ?></option>
								<?php }?>
							</select> 
							<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="username" placeholder="Username*" required>
							<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="password" name="password" placeholder="Password*" required>
							<center>
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<button type="submit" class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-20">
								Login
							</button>
							</center>
						</form>
					</div>
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