<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'articleImage'.DIRECTORY_SEPARATOR;
		
		$articleImage = DB:: getInstance()->get('articles', array('id','=',Input::get('newfile')));							
		foreach($articleImage->results() as $articleImage){
			unlink($PNG_TEMP_DIR.$articleImage->article_image);
		}
		
		$articles = new Articles();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/articleImage/"); 
			$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$articles->update(array(
					'article_image' => $image,
				), Input::get('newfile'));
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editArticle&&id='.Input::get('newfile'));
			} catch(Exception $e) {
				$error;
			}
}
ob_end_flush();