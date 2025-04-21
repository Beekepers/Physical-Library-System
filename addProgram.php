<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
		$programs = new Programs();
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
                $programs->create(array(
                    'programs' => Input::get('program'),
                    'programType' => Input::get('programType'),
                    'accLevel' => Input::get('accLevel'),
					'accPhase' => Input::get('accPhase'),
					'pppFile' => Input::get('pppFile'),
					'attachedFile' => $image,
                ));
			
			Session::flash('ProgramAdded', 'New Program has been successfully added.');
			Redirect::to('admin.php?action=listPrograms');
            } catch(Exception $e) {
                $error;
            }
}
ob_end_flush();