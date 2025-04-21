<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current
if (Input::exists()) {
		$validate = new Validate();
        $validation = $validate->check($_POST, array(
            'studentID' => array(
                'name' => 'Student ID',
                'required' => true,
                'unique' => 'trainees'
            ),
        ));
		if ($validate->passed()) {
			$trainees = new Trainees();
			if(isset($_FILES['upload']['tmp_name'])) {
				$upload = new Upload();
				$upload->SetFileName($_FILES['upload']['name']);
				$upload->SetTempName($_FILES['upload']['tmp_name']);
				$upload->SetUploadDirectory("admin/uploads/trainees/"); 
				$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
				$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
				$upload->UploadFile();
				$image = $upload->GetFileName();
			}
            try {
                $trainees->create(array(
					'studentID' => Input::get('studentID'),
					'lname' => Input::get('lname'),
					'fname' => Input::get('fname'),
					'mname' => Input::get('mname'),
					'civilstatus' => Input::get('civilstatus'),
					'sex' => Input::get('sex'),
					'paddress' => Input::get('paddress'),
					'nationality' => Input::get('nationality'),
					'bdate' => Input::get('bdate'),
					'bplace' => Input::get('bplace'),
					'age' => Input::get('age'),
					'height' => Input::get('height'),
					'weight' => Input::get('weight'),
					'fathername' => Input::get('fathername'),
					'foccupation' => Input::get('foccupation'),
					'fcontact' => Input::get('fcontact'),
					'mothername' => Input::get('mothername'),
					'moccupation' => Input::get('moccupation'),
					'mcontact' => Input::get('mcontact'),
					'elem' => Input::get('elem'),
					'esy' => Input::get('esy'),
					'secondary' => Input::get('secondary'),
					'hsy' => Input::get('hsy'),
					'tertiary' => Input::get('tertiary'),
					'major' => Input::get('major'),
                    'course' => Input::get('course'),
					'yearLevel' => Input::get('yearLevel'),
					'company_applied' => Input::get('company'),
					'registered' => 0,
					'studentpic' => $image,
                ));
			
			Session::flash('Added', 'New Trainee has been successfully added.');
			Redirect::to('admin.php?action=listTrainees');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}else{
			foreach ($validate->errors() as $error) {
				Session::flash('Error', $error);
				Redirect::to('admin.php?action=listTrainees');
            }
		}
}
ob_end_flush();