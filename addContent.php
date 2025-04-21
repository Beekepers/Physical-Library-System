<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
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
                $content->create(array(
					'topic' => Input::get('topic'),
                    'chapterTitle' => Input::get('title'),
					'content' => Input::get('content'),
					'attached_file' => $image,
                ));
			
			Session::flash('Added', 'New Chapter has been successfully added.');
			Redirect::to('admin.php?action=listContents');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();