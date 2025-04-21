<?php
require_once 'core/init.php';
require 'vendor/autoload.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_student_info':	
				$student = DB:: getInstance()->get('students', array('studentID','=',$_POST['studentID']));
				
				if ($student->count()){
					foreach($student->results() as $student){
						$id = $student->studentID;
						$fullname = $student->lname. ", " .$student->fname. " ".$student->mname ;
						$course = $student->course;
						$yrlvl = $student->yearLevel;
						$pcontact = $student->pcontact;
					}
					$attendance = new Attendance();
					$checkattendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE studentID = ".$id." AND class_info=".$_POST['class_info']."");		
					if ($checkattendance->count()){
						foreach($checkattendance->results() as $checkattendance){
							if ($checkattendance->time_out == ""){
								try {
									$attendance->update(array(
										'time_out' => date("h:i a"),
									),$checkattendance->id);
								
								$msg = '<div class="alert alert-success" >
											<i class="glyphicon glyphicon-ok"></i> A student has logged out.
										</div>';
								
								$MessageBird = new \MessageBird\Client('BBkjn5lY1ycynA1kWQ7x6NUgh');
								$Message 	 = new \MessageBird\Objects\Message();
								$Message->originator = "SDSSU";
								$Message->recipients = array($pcontact);
								$Message->body = 'Hello your child has logged out my class';

								$MessageBird->messages->create($Message);
								
								} catch(Exception $e) {
									$error;
								}
							}else{
								$msg = '<div class="alert alert-info" >
											<i class="glyphicon glyphicon-info-sign"></i> This Student has already logged in and logged out your classroom.
										</div>';
							}
						}
					}else{
						try {
							$attendance->create(array(
								'studentID' => $id,
								'class_info' => $_POST['class_info'],
								'name' => $fullname,
								'course' => $course,
								'yearLevel' => $yrlvl,
								'attendanceDate' => date("m/d/Y"),
								'time_in' => date("h:i a"),
								'time_out' => '',
							));
						$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> A student has logged in.
								</div>';
						
						$MessageBird = new \MessageBird\Client('BBkjn5lY1ycynA1kWQ7x6NUgh');
						$Message 	 = new \MessageBird\Objects\Message();
						$Message->originator = "SDSSU";
						$Message->recipients = array($pcontact);
						$Message->body = 'Hello your child has logged in my class';
						
						$MessageBird->messages->create($Message);
						
						} catch(Exception $e) {
							$error;
						}		
					}
					
				}else{
					$id = 'record not found';
					$fullname = '';
					$course = '';
					$yrlvl = '';
					$msg = '<div class="alert alert-danger" >
								<i class="glyphicon glyphicon-remove"></i> This record is not registered.
							</div>';
				}

				echo json_encode(['id'=>$id, 'fullname'=>$fullname, 'course'=>$course, 'yrlvl'=>$yrlvl, 'msg'=>$msg]);
			break;

		 default:
				;
		}
?>