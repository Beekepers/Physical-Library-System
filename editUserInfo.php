<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
	if(Token::check(Input::get('editUserInfo'))) {
		$user = new UserLogin(); //Current
			try {
				$user->update(array(
					'fname' => Input::get('fname'),
					'lname' => Input::get('lname'),
				), Session::get(Config::get('sessions/session_name')));
				Session::flash('userUpdated', 'User Information has been successfully updated.');
				Redirect::to('admin.php?action=settings');
			} catch(Exception $e) {
				$error;
			}
	}
}

if (Input::exists()) {
    if(Token::check(Input::get('avatar'))) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR;
		
		$avatar = DB:: getInstance()->get('userlogin', array('id','=',Session::get(Config::get('sessions/session_name'))));							
		foreach($avatar->results() as $avatar){
			unlink($PNG_TEMP_DIR.$avatar->avatar);
		}
		
		$user = new UserLogin(); //Current
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/avatar/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
            try {
                $user->update(array(
					'avatar' => $image,
				), Session::get(Config::get('sessions/session_name')));
				Session::flash('userUpdated', 'User Information has been successfully updated.');
				Redirect::to('admin.php?action=settings');
            } catch(Exception $e) {
                $error;
            }
    }
}
			
?>