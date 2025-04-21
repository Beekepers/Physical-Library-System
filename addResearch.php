<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
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
                $research->create(array(
                    'research' => Input::get('research'),
					'content' => Input::get('content'),
					'researchfile' => $image,
					'dateAdded' => date('m/d/Y'),
                ));
			Session::flash('Added', 'New Research has been successfully added.');
			Redirect::to('admin.php?action=listResearch');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();