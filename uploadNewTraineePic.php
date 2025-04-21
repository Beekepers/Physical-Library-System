<?php
ob_start();
include('core/init.php');
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainees'.DIRECTORY_SEPARATOR;
		
		$trainees = DB:: getInstance()->get('trainees', array('id','=',Input::get('sid')));							
		foreach($trainees->results() as $trainees){
			unlink($PNG_TEMP_DIR.$trainees->studentpic);
		}
		if(isset($_FILES['editpic']['tmp_name'])) {
				$upload = new Upload();
				$upload->SetFileName($_FILES['editpic']['name']);
				$upload->SetTempName($_FILES['editpic']['tmp_name']);
				$upload->SetUploadDirectory("admin/uploads/trainees/"); 
				$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
				$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
				$upload->UploadFile();
				$image = $upload->GetFileName();
			}
			$trainee = new Trainees();
			try {
					$trainee->update(array(
						'studentpic' => $image,
					),Input::get('sid'));
					Session::flash('PicUpdated', 'Image has been updated.');
					Redirect::to('profile.php');
				} catch(Exception $e) {
					$error;
				}
}
ob_end_flush();