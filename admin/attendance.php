<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
		$class = new ClassInfo();
		try {
			$class->update(array(
				'has_ended' => 1,
			),Input::get('class_id'));
			
		Redirect::to('admin.php?action=startAttendance');
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>SDSSU Cantilan Campus</title>
<style>
.video-box {
	margin: auto;
	width:90%;
	border:10px solid #dcdcdc;
	background-color: #dcdcdc;
}
.btn-huge{
	width:100%;
    padding:20px;
	margin-bottom:5px;
}
</style>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Classroom Attendance System
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Classroom Attendance System</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-user-circle"></i>  Start Attendance</h3>                           
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="row">
										<form enctype="multipart/form-data" method="post" action="" >
											<div class="row">
												<div class="col-xs-5">
													<div class="row">
														<div class="col-xs-12">
															<div class="video-box">
																<video width="100%" id="preview"></video>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<span id="msg" name="msg">
															</span>
														</div>
													</div>
												</div>
												<div class="col-xs-7">
													<div class="row">
														<?php
															$class_info = DB:: getInstance()->query("SELECT * FROM class_info WHERE id=".$_POST['class_info']."");							
															foreach($class_info->results() as $class_info){
														?>
														<div class="col-xs-2">
															<label class="control-label" for="class_info">Subject</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="class_info" name="class_info" value="<?php echo ucwords($class_info->subject).' - '.$class_info->schedule?>" readonly>
																<input type="hidden" class="form-control" id="class_id" name="class_id" value="<?php echo $class_info->id;?>" >
															</div>
														</div>
														<?php }?>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="qrcode">Student ID</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="qrcode" name="qrcode" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="fullname">Student Name</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="fullname" name="fullname" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="course">Course</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="course" name="course" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="yrlvl">Year Level</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="yrlvl" name="yrlvl" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
															<button type="submit" class="btn btn-info btn-lg btn-huge" name="classend" id="classend">END ATTENDANCE</button>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<a href="admin.php?action=startAttendance" type="button" class="btn btn-danger btn-lg btn-huge">CANCEL</a>
														</div>
													</div>
												</div>
											</div>
											<hr>
										</form>
									</div>
								</div><!-- /.box -->
								
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
	
	<script src="js/jquery3.3.1.min.js"></script>
	<script src="js/instascan.min.js"></script>
	<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
		var class_info = parseInt(document.getElementById("class_id").value);
		var studentID = content;
			$.ajax({
				type: "POST",
				url: "attendance.php",
				dataType: "json",
				data: {studentID:studentID, class_info:class_info, action:'view_student_info'},
				success : function(data){
					$("#qrcode").val(data.id);
					$("#fullname").val(data.fullname);
					$("#course").val(data.course);
					$("#yrlvl").val(data.yrlvl);
					$("#msg").html(data.msg);
				}
			});
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
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

