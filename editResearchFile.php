<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'researchfiles'.DIRECTORY_SEPARATOR;
		
		$attachedFile = DB:: getInstance()->get('research', array('id','=',Input::get('newfile')));							
		foreach($attachedFile->results() as $attachedFile){
			unlink($PNG_TEMP_DIR.$attachedFile->researchfile);
		}
		
		$research = new Research();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/researchfiles/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$research->update(array(
					'researchfile' => $image,
				), Input::get('newfile'));
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editResearch&&id='.Input::get('newfile'));
			} catch(Exception $e) {
				$error;
			}
}
ob_end_flush();