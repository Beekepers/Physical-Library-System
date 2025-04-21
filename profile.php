<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
	if(Token::check(Input::get('changePassToken'))) {
		$user = new UserLogin(); //Current
			$currentPass = Hash::make(Input::get('currentPassword'));
			if($user->data()->password === $currentPass) {
				$user->update(array(
					'password' => Hash::make(Input::get('newPassword')),
				));

				Session::flash('passwordChanged', 'Your password has been changed!');
			} else {
				Session::flash('wrongPassword', 'Your current password is wrong!');
			}
	}
	if(Token::check(Input::get('changeUsernameToken'))) {
		$user = new UserLogin(); //Current
			try {
				$user->update(array(
					'username' => Input::get('username'),
				), Session::get(Config::get('sessions/session_name')));
				Session::flash('Updated', 'Username has been successfully updated.');
				Redirect::to('profile.php');
			} catch(Exception $e) {
				$error;
			}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile - <?php echo $user->data()->username;?></title>
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
<!-- Bootstrap Validator CSS -->
	<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!--===============================================================================================-->
	<style>
	.progress-table {
	  background: #fff;
	  padding: 15px 0px 30px 0px;
	  min-width: 800px;
	  margin-left: 50px;
	}

	.progress-table .first {
	  width: 15%;
	  padding-left: 30px;
	}

	.progress-table .second {
	  width: 50%;
	}

	.progress-table .third {
	  width: 15%;
	  text-align: right;
	}

	.progress-table .table-head {
	  display: flex;
	}

	.progress-table .table-head .serial, .progress-table .table-head .country, .progress-table .table-head .visit, .progress-table .table-head .percentage {
	  color: #222222;
	  line-height: 40px;
	  text-transform: uppercase;
	  font-weight: 500;
	}

	.progress-table .table-row {
	  padding: 5px 0;
	  border-bottom: 1px solid #edf3fd;
	  display: flex;
	}
	</style>
	<script src="styles/jquery.min.js"></script> 
	<script type="text/javascript" src="styles/user/js/jquery.form.js"></script>
    <script type="text/javascript" >
     $(document).ready(function() { 
            
                $('#photoimg').live('change', function()			{ 
                           $("#preview").html('');
                    $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
                $("#imageform").ajaxForm({
                            target: '#preview'
            }).submit();
            
                });
            }); 
    </script>
    <style type="text/css">
		.imageAndText {
			position: relative;
		} 
		.imageAndText .col {
			position:absolute;
			top:85%; 
			z-index: 1; 
			left: 0;
		}
        .uploadFile {
        background: url('images/whitecam.png') no-repeat;
        height: 32px;
        width: 32px;
        overflow: hidden;
        cursor: pointer;
        }
        .uploadFile input {
        filter: alpha(opacity=0);
        opacity: 0;
        margin-left: -110px;
        }
        .custom-file-input {
        height: 25px;
        cursor: pointer;
        }
    </style>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
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
					Profile - <?php echo $user->data()->username;?>
				</span>
			</div>
		</div>
	</div>
	
	<!-- Content -->
	<section class="bg0 p-b-20">
		<div class="container">
					<div class="p-r-10 p-r-0-sr991">
						<?php 
						$user = DB::getInstance()->get('userlogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
						foreach($user->results() as $user){
							$trainees = DB::getInstance()->get('trainees', array('login_id','=',$user->login_id));
							foreach($trainees->results() as $trainees){
						?>
						<div class="row">
							<div class="col-lg-3">
								<div class="row">
									<div class="col-xs-2">
										<img width="100%" style="border: 7px solid #dfe0e1; ;border-radius:4px" src="admin/uploads/trainees/<?php echo $trainees->studentpic;?>">
									</div>
								</div>
								<form enctype="multipart/form-data" method="post" action="uploadNewTraineePic.php" >
									<div class="row">
										<div class="col-xs-5">
											<div class="uploadFile">
												<input type="file" name="editpic" accept=".jpg,.jpeg,.png" required>
												<input type="hidden" name="sid" value="<?php echo $trainees->id;?>" >
											</div>
										</div>
										<div class="col-xs-4" style="padding-top:6px;margin-left:2px;">
											<button type="submit" class="btn btn-xs btn-success">Change Picture</button>
										</div>
									</div>
								</form>
								<?php if(Session::exists('PicUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('PicUpdated'); ?>
                                    </div>
								<?php }?>
							</div>
							<div class="col-lg-9">
								<h4 class="f1-l-2 cl2 p-b-20">Personal Data</h4>
								<table class="table table-hover">
									<tr>
										<td>Civil Status : <b><?php echo $trainees->civilstatus;?></b></td>
										<td>Sex : <b><?php echo $trainees->sex;?></b></td>
									</tr>
									<tr>
										<td>Permanent Address : <b><?php echo $trainees->paddress;?></b></td>
										<td>Age : <b><?php echo $trainees->age;?></b></td>
									</tr>
									<tr>
										<td>Nationality : <b><?php echo $trainees->nationality;?></b></td>
										<td>Birthdate : <b><?php echo $trainees->bdate;?></b></td>
									</tr>
									<tr>
										<td>Birth Place: <b><?php echo $trainees->bplace;?></b></td>
										<td>Weight : <b><?php echo $trainees->weight;?></b> | Height : <b><?php echo $trainees->height;?></b></td>
									</tr>
								</table>	
								<h4 class="f1-l-2 cl2 p-t-20 p-b-20">Family Background</h4>
								<table class="table table-hover">
									<tr>
										<td>Father : <b><?php echo $trainees->fathername;?></b></td>
										<td></td>
									</tr>
									<tr>
										<td>Occupation: <b><?php echo $trainees->foccupation;?></b></td>
										<td>Contact : <b><?php echo $trainees->fcontact;?></b></td>
									</tr>
									<tr>
										<td>Mother : <b><?php echo $trainees->mothername;?></b></td>
										<td></td>
									</tr>
									<tr>
										<td>Occupation: <b><?php echo $trainees->moccupation;?></b></td>
										<td>Contact : <b><?php echo $trainees->mcontact;?></b></td>
									</tr>
								</table>
								<h4 class="f1-l-2 cl2 p-t-20 p-b-20">Education Background</h4>
								<table class="table table-hover">
									<tr>
										<td>Elementary :</td>
										<td> <b><?php echo $trainees->elem;?></b></td>
									</tr>
									<tr>
										<td>School Year :</td>
										<td> <b><?php echo $trainees->esy;?></b></td>
									</tr>
									<tr>
										<td>Secondary :</td>
										<td> <b><?php echo $trainees->secondary;?></b></td>
									</tr>
									<tr>
										<td>School Year :</td>
										<td> <b><?php echo $trainees->hsy;?></b></td>
									</tr>
									<tr>
										<td>Tertiary :</td>
										<td> <b><?php echo $trainees->tertiary;?></b></td>
									</tr>
									<tr>
										<td>Course: <b><?php echo $trainees->course;?></b></td>
										<td>Major : <b><?php echo $trainees->major;?></b></td>
									</tr>
								</table>	
							</div>
						</div>
							<?php }
						}?>
					</div>
					<hr>
		</div>
	</section>
	<!-- Page heading -->
	<div class="container p-t-4 p-b-10">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="f1-l-2 cl2">
					Account Login Information
				</h3>
			</div>
		</div>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
										<div class="progress-table">
											<?php 
											$user = DB::getInstance()->get('userlogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
											foreach($user->results() as $user){
											?>
												<div class="table-row">
													<div class="first">Username:</div>
													<div class="second">
														<div id="changeUsernameMessage">
														<?php echo $user->username;?>
														<?php if(Session::exists('Updated')){ ?>
																	<p class="text-success"><?php echo Session::flash('Updated'); ?></p>
														<?php }?>
														</div>
														
														<div id="changeUname" style="display: none">
															<b>Change Username</b><hr>
															<form id="changeUsername" action="" method="post"  class="col-xs-10">
																<div class="form-group">
																	Username:
																	<input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username;?>">
																</div>        
																<input type="hidden" name="changeUsernameToken" value="<?php echo Token::generate(); ?>">
																<button type="submit" class="btn btn-success">Save Changes</button>	
																<button id="cancelUsername" type="button" class="btn btn-danger">Cancel</button>	
															</form>
														</div>
													</div>
													<div class="third"><button class="edit_link btn btn-link" id="editUsername">Edit Username</button></div>
												</div>
												<div class="table-row">
													<div class="first">Password:</div>
													<div class="second">
														<div id="changepassmessage">
														Change your password here
														<?php if(Session::exists('wrongPassword')){ ?>
																	<p class="text-danger"><?php echo Session::flash('wrongPassword'); ?></p>
														<?php }?>
														<?php if(Session::exists('passwordChanged')){ ?>
																	<p class="text-success"><?php echo Session::flash('passwordChanged'); ?></p>
														<?php }?>
														</div>
														
														<div id="changePass" style="display: none">
															<b>Change your password here</b><hr>
															<form id="changePassword" action="" method="post"  class="col-xs-10">
																<div class="form-group">
																	<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" >
																</div>        
																<div class="form-group">
																	<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
																</div>
																<div class="form-group">
																	<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
																</div>
																<input type="hidden" name="changePassToken" value="<?php echo Token::generate(); ?>">
																<button type="submit" class="btn btn-success">Save Changes</button>	
																<button id="cancelPass" type="button" class="btn btn-danger">Cancel</button>	
															</form>
														</div>
													</div>
													<div class="third"><button class="edit_link btn btn-link" id="change">Change Password</button></div>
												</div>
											<?php 
											}?>
										</div>
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
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
	$(document).ready(function(){
		$("#cancelPass").click(function(){
			$("#change").show();
			$("#changePass").hide();
			$("#changepassmessage").show();				
		});
		
		$("#change").click(function(){
			$("#change").hide();
			$("#changePass").show();
			$("#changepassmessage").hide();			
		});
		
		$("#cancelUsername").click(function(){
			$("#editUsername").show();
			$("#changeUname").hide();
			$("#changeUsernameMessage").show();			
		});
		
		$("#editUsername").click(function(){
			$("#editUsername").hide();
			$("#changeUname").show();
			$("#changeUsernameMessage").hide();			
		});
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var validator = $("#changePassword").bootstrapValidator({
				fields : {
					currentPassword : {
						validators : {
							notEmpty :{
								message : "Password is required."
							},
							stringLength :{
								min : 6,
								max : 35,
								message : "Password must be beetween 6 and 35 characters long"
							}
						}
					},
					newPassword : {
						validators : {
							notEmpty :{
								message : "New Password is required."
							},
							stringLength :{
								min : 6,
								max : 35,
								message : "Password must be beetween 6 and 35 characters long"
							}
						}
					},
					confirmNewPassword : {
						validators : {
							notEmpty :{
								message : "Confirm new password is required."
							},
							stringLength :{
								min : 6,
								max : 35,
								message : "Password must be beetween 6 and 35 characters long"
							},
							identical: {
								field: 'newPassword',
								message: 'This must be the same as the password'
							}
						}
					},
				}
			});
		});
	</script>
</body>
</html>