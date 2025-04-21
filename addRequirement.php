<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
		$requirement = new Requirements();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/ojtrequirements/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
            try {
                $requirement->create(array(
                    'name' => Input::get('rname'),
					'attachedFile' => $image,
                ));
			Session::flash('Added', 'New File has been successfully added.');
			Redirect::to('admin.php?action=listRequirements');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();