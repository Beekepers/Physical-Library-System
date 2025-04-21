<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
			$trainee = new Trainees();
			
            try {
                $trainee->update(array(
					'studentID' => Input::get('studentID'),
					'lname' => Input::get('lname'),
					'fname' => Input::get('fname'),
					'mname' => Input::get('mname'),
					'civilstatus' => Input::get('civilstatus'),
					'sex' => Input::get('sex'),
					'paddress' => Input::get('paddress'),
					'nationality' => Input::get('nationality'),
					'bdate' => Input::get('bdate'),
					'bplace' => Input::get('bplace'),
					'age' => Input::get('age'),
					'height' => Input::get('height'),
					'weight' => Input::get('weight'),
					'fathername' => Input::get('fathername'),
					'foccupation' => Input::get('foccupation'),
					'fcontact' => Input::get('fcontact'),
					'mothername' => Input::get('mothername'),
					'moccupation' => Input::get('moccupation'),
					'mcontact' => Input::get('mcontact'),
					'elem' => Input::get('elem'),
					'esy' => Input::get('esy'),
					'secondary' => Input::get('secondary'),
					'hsy' => Input::get('hsy'),
					'tertiary' => Input::get('tertiary'),
					'major' => Input::get('major'),
                    'course' => Input::get('course'),
					'yearLevel' => Input::get('yearLevel'),
					'company_applied' => Input::get('company'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Student Info has been successfully updated.');
			Redirect::to('admin.php?action=listTrainees');
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
                        OJT Student Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=listTrainees">OJT Student Lists</a></li>
                        <li class="active">Edit OJT Student Information</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit OJT Student Info - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php 
									$trainee = DB:: getInstance()->get('trainees', array('id','=',$_GET['id']));							
									foreach($trainee->results() as $trainee){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="studentID"><font color="#EC0003">*</font> Student ID</label>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-8 col-md-8">
														<input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $trainee->studentID; ?>" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<h3>Personal Data</h3>
									<hr>
													<div class="row">
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="lname"><font color="#EC0003">*</font> Lastname</label>
															<div class="form-group">
																<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $trainee->lname; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="fname"><font color="#EC0003">*</font> Firstname</label>
															<div class="form-group">
																<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $trainee->fname; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="mname"><font color="#EC0003">*</font> Middlename</label>
															<div class="form-group">
																<input type="text" class="form-control" id="mname" name="mname" value="<?php echo $trainee->mname; ?>" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="civilstatus"><font color="#EC0003">*</font> Civil Status</label>
															<div class="form-group">
																<?php
																$civilstatus = array	(	'Single' => 'Single',
																						'Married' => 'Married',
																						'Separated' => 'Separated', 
																						'Widow/Widower' => 'Widow/Widower'
																					);?>
																<select name="civilstatus" class="form-control" id="civilstatus" required>
																	<option hidden value="">Select One</option>
																	<?php
																		foreach($civilstatus as $value => $key):
																			if ($value == $trainee->civilstatus){
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
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="sex"><font color="#EC0003">*</font> Sex</label>
															<?php
																$sex = array	(	'Male' => 'Male',
																					'Female' => 'Female'
																					);?>
																<select name="sex" class="form-control" id="sex" required>
																	<option hidden value="">Select One</option>
																	<?php
																		foreach($sex as $value => $key):
																			if ($value == $trainee->sex){
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
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="age"><font color="#EC0003">*</font> Age</label>
															<div class="form-group">
																<input type="text" class="form-control" id="age" name="age" value="<?php echo $trainee->age; ?>" required>
															</div>
														</div>
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="bdate"><font color="#EC0003">*</font> Birthdate</label>
															<div class="form-group">
																<input type="text" class="form-control" id="bdate" name="bdate" value="<?php echo $trainee->bdate; ?>" required  data-provide="datepicker">
															</div>
														</div>
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="nationality"><font color="#EC0003">*</font> Nationality</label>
															<div class="form-group">
																<input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $trainee->nationality; ?>" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="paddress"><font color="#EC0003">*</font> Permanent Address</label>
															<div class="form-group">
																<input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $trainee->paddress; ?>" required>
															</div>
														</div>
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="bplace"><font color="#EC0003">*</font> Birthplace</label>
															<div class="form-group">
																<input type="text" class="form-control" id="bplace" name="bplace" value="<?php echo $trainee->bplace; ?>" required>
															</div>
														</div>
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="height"><font color="#EC0003">*</font> Height</label>
															<div class="form-group">
																<input type="text" class="form-control" id="height" name="height" value="<?php echo $trainee->height; ?>" required>
															</div>
														</div>
														<div class="col-lg-2 col-md-2">
															<label class="control-label" for="weight"><font color="#EC0003">*</font> Weight</label>
															<div class="form-group">
																<input type="text" class="form-control" id="weight" name="weight" value="<?php echo $trainee->weight; ?>" required> 
															</div>
														</div>
													</div>
													<div class="row">
													</div>
													<h3>Family Background</h3>
													<hr>
													<div class="row">
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="fathername"><font color="#EC0003">*</font> Fathers Name</label>
															<div class="form-group">
																<input type="text" class="form-control" id="fathername" name="fathername" value="<?php echo $trainee->fathername; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="foccupation"><font color="#EC0003">*</font> Fathers Occupation</label>
															<div class="form-group">
																<input type="text" class="form-control" id="foccupation" name="foccupation" value="<?php echo $trainee->foccupation; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="fcontact"><font color="#EC0003">*</font> Fathers Contact Number</label>
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="fcontact" name="fcontact" value="<?php echo $trainee->fcontact; ?>" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="mothername"><font color="#EC0003">*</font> Mothers Name</label>
															<div class="form-group">
																<input type="text" class="form-control" id="mothername" name="mothername" value="<?php echo $trainee->mothername; ?>"required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="moccupation"><font color="#EC0003">*</font> Mothers Occupation</label>
															<div class="form-group">
																<input type="text" class="form-control" id="moccupation" name="moccupation" value="<?php echo $trainee->moccupation; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="mcontact"><font color="#EC0003">*</font> Mothers Contact Number</label>
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="mcontact" name="mcontact" value="<?php echo $trainee->mcontact; ?>" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
													<h3>Educational Background</h3>
													<hr>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="elem"><font color="#EC0003">*</font> Elementary</label>
															<div class="form-group">
																<input type="text" class="form-control" id="elem" name="elem" value="<?php echo $trainee->elem; ?>" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="esy"><font color="#EC0003">*</font> School Year</label>
															<div class="form-group">
																<input type="text" class="form-control" id="esy" name="esy" value="<?php echo $trainee->esy; ?>" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="secondary"><font color="#EC0003">*</font> Secondary</label>
															<div class="form-group">
																<input type="text" class="form-control" id="secondary" name="secondary" value="<?php echo $trainee->secondary; ?>" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="hsy"><font color="#EC0003">*</font> School Year</label>
															<div class="form-group">
																<input type="text" class="form-control" id="hsy" name="hsy" value="<?php echo $trainee->hsy; ?>" required>
															</div>
														</div>
													</div>
													<label class="control-label" for="tertiary"><font color="#EC0003">*</font> Tertiary</label>
													<div class="form-group">
														<input type="text" class="form-control" id="tertiary" name="tertiary" value="<?php echo $trainee->tertiary; ?>" required>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="course"><font color="#EC0003">*</font> Course</label>
															<div class="form-group">
																<input type="text" class="form-control" id="course" name="course" value="<?php echo $trainee->course; ?>" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-3">
															<label class="control-label" for="major"><font color="#EC0003">*</font> Major</label>
															<div class="form-group">
																<input type="text" class="form-control" id="major" name="major" value="<?php echo $trainee->major; ?>" required>
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
																				if ($value == $trainee->yearLevel){
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
															<label class="control-label" for="company"><font color="#EC0003">*</font> Applied Company</label>
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="company" name="company" value="<?php echo $trainee->company_applied; ?>" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=listTrainees'">Cancel</button>
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