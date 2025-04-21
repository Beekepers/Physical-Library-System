<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$userlogin = new UserLogin();
			try {
				$userlogin->update(array(
					'username' => Input::get('username'),
					'permission' => Input::get('role'),
				), $_GET['uid']);
				Session::flash('UserUpdated', 'User Info has been successfully updated.');
				Redirect::to('admin.php?action=userList');
			} catch(Exception $e) {
				$error;
			}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<title>SDSSU Cantilan Campus</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=userList">User Lists</a></li>
                        <li class="active">Edit User</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit User - <small><font color="#EC0003">*</font> required fields</small></h3>    
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php 
									$users = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id=".$_GET['uid']."");							
									foreach($users->results() as $users){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
											<label class="control-label" for="username"><font color="#EC0003">*</font> Username</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $users->username; ?>">
                                            </div>
                                        </div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="role"><font color="#EC0003">*</font> User Role:</label>
                                            <div class="form-group">
												<select class="form-control" name="role" id="role">
													<option hidden value="">Select Role</option>
													<?php
														$userRole = DB:: getInstance()->query("SELECT * FROM groups");							
														foreach($userRole->results() as $userRole){
														if ($userRole->id == $users->permission){
															$selected = 'selected';
														}else{
															$selected = '';;
														}
													?>
													<option value="<?php echo $userRole->id;?>" <?php echo $selected; ?>><?php echo ucwords($userRole->name); ?></option>
													<?php }?>
												</select>
                                            </div>
										
                                        </div>
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=userList'">Cancel</button>
                                    </div>
                                    <br />
                                </form>         
								<?php }?>                 
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>    
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>