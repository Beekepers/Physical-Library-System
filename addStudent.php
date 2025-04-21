<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";   
$user = new UserLogin(); //Current

if (Input::exists()) {
		$students = DB:: getInstance()->query("SELECT * FROM students WHERE teacher_id=".$user->data()->id." AND studentID= ".Input::get('studentID')."");		
		if ($students->count()){
			Session::flash('Error', 'Student exist!');
		}else{
			$student = new Students();
			//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'studentQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			//processing form input
			//remember to sanitize user input in real-life solution !!!
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			if (isset($_REQUEST['studentID'])) { 
				// user data
				$newfilename = round(microtime(true)).'.png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($_REQUEST['studentID'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			
            try {
                $student->create(array(
					'teacher_id' => $user->data()->id,
					'studentID' => Input::get('studentID'),
					'lname' => Input::get('lname'),
					'fname' => Input::get('fname'),
					'mname' => Input::get('mname'),
                    'course' => Input::get('course'),
					'yearLevel' => Input::get('yearLevel'),
					'pcontact' => '+'.Input::get('pcontact'),
					'qrcode' => $newfilename,
                ));
			
			Session::flash('Added', 'New Student has been successfully added.');
			Redirect::to('admin.php?action=listStudents');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
}
ob_end_flush();