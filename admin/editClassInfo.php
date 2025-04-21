<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$classInfo = new ClassInfo();
			try {
				$classInfo->update(array(
					'course' => Input::get('course'),
                    'subject' => Input::get('subject'),
					'schedule' => Input::get('schedule'),
				), $_GET['id']);
				Session::flash('Updated', 'Class Info has been updated.');
				Redirect::to('admin.php?action=listClass');
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
                        Topic Info
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=listTopics">Topic Lists</a></li>
                        <li class="active">Edit Topic</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Topic - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php 
									$classInfo = DB:: getInstance()->query("SELECT * FROM class_info WHERE id=".$_GET['id']."");							
									foreach($classInfo->results() as $classInfo){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="course"><font color="#EC0003">*</font> Course</label>
											<div class="form-group">
												<input type="text" class="form-control" id="course" name="course"  value="<?php echo $classInfo->course; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="subject"><font color="#EC0003">*</font> Subject</label>
											<div class="form-group">
												<input type="text" class="form-control" id="subject" name="subject"  value="<?php echo $classInfo->subject; ?>" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="schedule"><font color="#EC0003">*</font> Schedule</label>
											<div class="form-group">
												<input type="text" class="form-control" id="schedule" name="schedule" value="<?php echo $classInfo->schedule; ?>" required>
											</div>
										</div>
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=listClass'">Cancel</button>
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
</body>
</html>