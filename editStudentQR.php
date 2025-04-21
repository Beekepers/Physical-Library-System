<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";  
if (Input::exists()) {
	//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'studentQRCodes'.DIRECTORY_SEPARATOR;
			
			$student = DB:: getInstance()->get('students', array('id','=',Input::get('newID')));							
			foreach($student->results() as $student){
				unlink($PNG_TEMP_DIR.$student->qrcode);
			}
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			//processing form input
			//remember to sanitize user input in real-life solution !!!
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			if (isset($_REQUEST['newstudentID'])) { 
				// user data
				$newfilename = round(microtime(true)).'.png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($_REQUEST['newstudentID'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$student = new Students();
			
            try {
                $student->update(array(
					'studentID' => Input::get('newstudentID'),
					'qrcode' => $newfilename,
                ), Input::get('newID'));
			
			Session::flash('SidUpdated', 'StudentID has been updated');
			Redirect::to('admin.php?action=editStudentInfo&&id='.Input::get('newID'));
            } catch(Exception $e) {
                $error;
            }
}
ob_end_flush();