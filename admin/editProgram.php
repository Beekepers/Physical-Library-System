<?php
if (Input::exists()) {
			$program = new Programs();
			
            try {
                $program->update(array(
					'programs' => Input::get('program'),
					'programType' => Input::get('ptype'),
					'accLevel' => Input::get('accLevel'),
					'accPhase' => Input::get('accPhase'),
					'pppFile' => Input::get('pppFile'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Student Info has been successfully updated.');
			Redirect::to('admin.php?action=listPrograms');
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
								<?php if(Session::exists('NewFile')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('NewFile'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$program = DB:: getInstance()->get('programs', array('id','=',$_GET['id']));							
									foreach($program->results() as $program){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
										<div class="col-lg-3 col-md-3">
												<label class="control-label" for="ptype"><font color="#EC0003">*</font> ProgramType:</label>
													<div class="form-group">
														<select class="form-control" name="ptype" id="ptype">
															<option hidden value="">Select Topic</option>
															<?php
																$ptype = DB:: getInstance()->query("SELECT * FROM programtype");							
																foreach($ptype->results() as $ptype){
																if ($ptype->id == $program->programType){
																	$selected = 'selected';
																}else{
																	$selected = '';;
																}
															?>
															<option value="<?php echo $ptype->id;?>" <?php echo $selected; ?>><?php echo ucwords($ptype->type); ?></option>
															<?php }?>
														</select>
													</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="program"><font color="#EC0003">*</font> Program</label>
											<div class="form-group">
												<input type="text" class="form-control" id="program" name="program" value="<?php echo $program->programs; ?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="col-lg-2 col-md-2">
											<label class="control-label" for="accLevel"><font color="#EC0003">*</font> Accreditation Level</label>
											<div class="form-group">
												<input type="text" class="form-control" id="accLevel" name="accLevel" value="<?php echo $program->accLevel; ?>" >
											</div>
										</div>
										<div class="col-lg-2 col-md-2">
											<label class="control-label" for="accPhase"><font color="#EC0003">*</font> Accreditation Phase</label>
											<div class="form-group">
												<input type="text" class="form-control" id="accPhase" name="accPhase" value="<?php echo $program->accPhase; ?>" >
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="pppFile"><font color="#EC0003">*</font> PPP File</label>
											<div class="form-group">
												<input type="text" class="form-control" id="pppFile" name="pppFile" value="<?php echo $program->pppFile; ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5 col-md-5">
											<a href="admin/uploads/qaFiles/<?php echo $program->attachedFile; ?>" type="button" class="btn btn-success" target="_blank">
												View Attached File
											</a>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploads">
												Upload a New File
											</button>
										</div>		
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=listPrograms'">Cancel</button>
                                    </div>
                                    <br />
                                </form>
													<!-- Modal -->
													<div class="modal fade" id="uploads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Add New Content</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="editqaAttachedFile.php">
																<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload New Attachment</label>
																<div class="form-group">
																	<input name='upload' type='file' accept="application/pdf" required/>
																</div>
																<input type="hidden" name="newfile" value="<?php echo $program->id; ?>">
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

</body>
</html>