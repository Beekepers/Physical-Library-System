<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
$output = '';
$attendanceDate = $_POST['adate'];
$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE class_info=".$_POST['class_info']."");		
if ($attendance->count()){
	$output .= '<div class="box-header">
					<h3 class="box-title">Attendance List</h3>                           
				</div><!-- /.box-header -->';
	$output .= '<div class="box-body table-responsive">
					<table class="table table-bordered table-hover" id="articles">
						<thead>
							<tr>
								<th>Student ID</th>
								<th>Full Name</th>
								<th>Course and Year Level</th>
								<th>Time In</th>
								<th>Time Out</th>
							</tr>
						</thead>
                        <tbody>';
	foreach($attendance->results() as $attendance){
		if ($attendance->attendanceDate == $attendanceDate){
		$output .=	'		<tr>
								<td>'.$attendance->studentID.'</td>
								<td>'.$attendance->name.'</td>
								<td>'.$attendance->course.' - '.$attendance->yearLevel.'</td>
								<td>'.$attendance->time_in.'</td>
								<td>'.$attendance->time_out.'</td>
							</tr>';
		}
			}
		$output .=		'</tbody>
					</table>
				</div>';
	
	echo $output;
	
}else{
	echo 'No data Found'.$attendanceDate;
}
?>

                                
                                