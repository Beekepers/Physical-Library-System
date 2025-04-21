<?php
if (Input::exists()) {
			$student = new Students();
			
            try {
                $student->update(array(
					'lname' => Input::get('lname'),
					'fname' => Input::get('fname'),
					'mname' => Input::get('mname'),
                    'course' => Input::get('course'),
					'yearLevel' => Input::get('yearLevel'),
					'pcontact' => Input::get('pcontact')
                ), $_GET['id']);
			
			Session::flash('Updated', 'Student Info has been successfully updated.');
			Redirect::to('admin.php?action=listStudents');
            } catch(Exception $e) {
                $error;
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
                        Student Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=userList">Student Lists</a></li>
                        <li class="active">Edit Student Information</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Student - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<?php if(Session::exists('SidUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('SidUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$student = DB:: getInstance()->get('students', array('id','=',$_GET['id']));							
									foreach($student->results() as $student){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="studentID"><font color="#EC0003">*</font> Student ID</label>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-8 col-md-8">
														<input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $student->studentID; ?>" disabled>
													</div>
													<div class="col-lg-4 col-md-4">
														<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editStudentID">
															Edit Student ID
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="lname"><font color="#EC0003">*</font> Lastname</label>
											<div class="form-group">
												<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $student->lname; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="fname"><font color="#EC0003">*</font> Firstname</label>
											<div class="form-group">
												<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $student->fname; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="mname"><font color="#EC0003">*</font> Middlename</label>
											<div class="form-group">
												<input type="text" class="form-control" id="mname" name="mname" value="<?php echo $student->mname; ?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-2 col-md-2">
											<label class="control-label" for="course"><font color="#EC0003">*</font> Course</label>
											<div class="form-group">
												<input type="text" class="form-control" id="course" name="course" value="<?php echo $student->course; ?>" required>
											</div>
										</div>
										<div class="col-lg-2 col-md-2">
											<label class="control-label" for="yearLevel"><font color="#EC0003">*</font> Year Level</label>
											<div class="form-group">
												<?php
													$yearLevel =array	(	'1st Year' => '1st Year',
																			'2nd Year' => '2nd Year',
																			'3rd Year' => '3rd Year', 
																			'4th Year' => '4th Year'
																		);?>
													<select name="yearLevel" class="form-control" id="yearLevel" >
														<option value="">Year</option>
														<?php
															foreach($yearLevel as $value => $key):
																if ($value == $student->yearLevel){
																	$selected = 'selected';
																}else{
																	$selected = '';
																}
														?>
														<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $key; ?></option>
														<?php
															endforeach;
														?>
													</select>
											</div>	
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="pcontact"><font color="#EC0003">*</font> Parent Contact Number</label>
											<div class="form-group">
												<input type="text" maxlength="13" class="form-control" id="pcontact" name="pcontact" value="<?php echo $student->pcontact; ?>" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
											</div>
										</div>
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=listStudents'">Cancel</button>
                                    </div>
                                    <br />
                                </form>
								<!-- Modal -->
													<div class="modal fade" id="editStudentID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Add New Content</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="editStudentQR.php">
																<label class="control-label" for="newstudentID"><font color="#EC0003">*</font> Student ID</label>
																<div class="form-group">
																	<input type="text" class="form-control" id="newstudentID" name="newstudentID" value="<?php echo $student->studentID; ?>">													
																</div>
																<input type="hidden" name="newID" value="<?php echo $student->id; ?>">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</form>
														</div>
														</div>
													</div>
													</div>
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