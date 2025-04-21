<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
$output = '';
if (isset($_POST['export'])){
	
		$attendanceDate = $_POST['adate'];
		$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE class_info=".$_POST['class_info']."");		
		if ($attendance->count()){
			$output .= '<h3>'.$attendanceDate.'</h3>';
			$output .= '<table>
							<tr>
								<th>Student ID</th>
								<th>Full Name</th>
								<th>Course and Year Level</th>
								<th>Time In</th>
								<th>Time Out</th>
							</tr>';
			foreach($attendance->results() as $attendance){
				if ($attendance->attendanceDate == $attendanceDate){
				$output .=	'<tr>
								<td>'.$attendance->studentID.'</td>
								<td>'.$attendance->name.'</td>
								<td>'.$attendance->course.' - '.$attendance->yearLevel.'</td>
								<td>'.$attendance->time_in.'</td>
								<td>'.$attendance->time_out.'</td>
							</tr>';
				}
					}
			$output .= '</table>';
			header('Content-Type: application/xls');
			header('Content-Disposition: attachment; filename=download.xls');
			echo $output;
			
		}
}
		?>

                                
                                