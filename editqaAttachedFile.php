<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'qaFiles'.DIRECTORY_SEPARATOR;
		
		$program = DB:: getInstance()->get('programs', array('id','=',Input::get('newfile')));							
		foreach($program->results() as $program){
			unlink($PNG_TEMP_DIR.$program->attachedFile);
		}
		
		$program = new Programs();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/qaFiles/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$program->update(array(
					'attachedFile' => $image,
				), Input::get('newfile'));
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editProgram&&id='.Input::get('newfile'));
			} catch(Exception $e) {
				$error;
			}
}
ob_end_flush();