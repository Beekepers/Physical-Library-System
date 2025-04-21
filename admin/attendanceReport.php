<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
			
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
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<title>SDSSU Cantilan Campus</title>
<style>
.btn-huge{
	width:100%;
    padding:20px;
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
                                    <h3 class="box-title"><i class="fa fa-user-circle"></i>  View Report</h3>                           
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<form method="post" action="export.php">
										<div class="row">
											<div class="col-xs-1">
												<label class="control-label" for="class_info"> Select Class:</label>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<select class="form-control" name="class_info" id="class_info" required>
														<option hidden value="">Select Class</option>
														<?php
														$class_info = DB:: getInstance()->query("SELECT * FROM class_info WHERE has_ended=true AND teacher_id=".$user->data()->id."");							
														foreach($class_info->results() as $class_info){
														?>
															<option value="<?php echo $class_info->id?>"><?php echo ucwords($class_info->subject).' - '.$class_info->schedule?></option>
														<?php }?>
													</select> 
												</div>
											</div>
											<div class="col-xs-1">
												<label class="control-label" for="adate"> Select Date:</label>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<input type="text" class="form-control" id="adate" name="adate" placeholder="mm/dd/yyyy" required  data-provide="datepicker">
												</div>
											</div>
											<div class="col-xs-1">
												<button type="button" class="btn btn-success btn-md" id="viewreport" name="viewreport">View Report</a>
											</div>
											<div class="col-xs-2">
												<input type="submit" name="export" class="btn btn-success" value="Export To Excel" />
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<span style="color:red" id="errorReport"></span>
											</div>
										</div>
									</form>
								</div><!-- /.box -->
							</div><!-- /.box -->
							<div class="box box-primary">
								<span id="reportAttendance"></span>
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	
	<script src="js/jquery3.3.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#viewreport").on('click',function() { 	
				var class_info = $("#class_info").val();
				var adate = $("#adate").val();
				if (class_info == "" || adate == ""){
					$("#errorReport").html('Please select a class and date to view the report.');
				}else{
					$.ajax({
							url: "attendanceReport.php",
							type: "post",
							data: {class_info:class_info, adate:adate},
							dataType: "text",
							success : function(data){
								$("#reportAttendance").html(data);
								$("#errorReport").html('');
							}
						});
				}
			});
		});
	</script>
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
</body>
</html>

