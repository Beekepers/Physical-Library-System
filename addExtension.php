<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
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
		if(isset($_FILES['extension_image']['tmp_name'])) {
			$extImage = new Upload();
			$extImage->SetFileName($_FILES['extension_image']['name']);
			$extImage->SetTempName($_FILES['extension_image']['tmp_name']);
			$extImage->SetUploadDirectory("admin/uploads/extArticleImage/"); 
			$extImage->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
			$extImage->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$extImage->UploadFile();
			$extensionImage = $extImage->GetFileName();
		}
            try {
                $extension->create(array(
                    'ext_activity' => Input::get('ext_activity'),
					'ext_content' => Input::get('content'),
					'attachedFile' => $image,
					'extension_image' => $extensionImage,
					'dateAdded' => date('m/d/Y'),
                ));
			Session::flash('Added', 'New Research has been successfully added.');
			Redirect::to('admin.php?action=listExtension');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();