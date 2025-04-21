<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'topic_contents'.DIRECTORY_SEPARATOR;
		
		$attachedFile = DB:: getInstance()->get('topic_contents', array('id','=',Input::get('newfile')));							
		foreach($attachedFile->results() as $attachedFile){
			unlink($PNG_TEMP_DIR.$attachedFile->attached_file);
		}
		
		$content = new Contents();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/topic_contents/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$content->update(array(
					'attached_file' => $image,
				), Input::get('newfile'));
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editTopicContent&&id='.Input::get('newfile'));
			} catch(Exception $e) {
				$error;
			}
}
ob_end_flush();