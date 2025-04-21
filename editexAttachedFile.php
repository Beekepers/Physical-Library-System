<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'extensionfiles'.DIRECTORY_SEPARATOR;
		
		$attachedFile = DB:: getInstance()->get('extension', array('id','=',Input::get('eid')));							
		foreach($attachedFile->results() as $attachedFile){
			unlink($PNG_TEMP_DIR.$attachedFile->attachedFile);
		}
		
		$extension = new Extension();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/extensionfiles/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$extension->update(array(
					'attachedFile' => $image,
				), Input::get('eid'));
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editExtension&&id='.Input::get('eid'));
			} catch(Exception $e) {
				$error;
			}
}
ob_end_flush();