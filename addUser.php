<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'name' => 'username',
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'userlogin'
			),
		));
		if ($validate->passed()) {
			$user = new Userlogin();
            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password')),
                    'joined' => date('Y-m-d H:i:s'),
                    'permission' => Input::get('userRole'),
					'fname' => '',
					'lname' => '',
					'login_id' => '',
					'avatar' => '',
					'current_session' => 0,
					'online' => 0,
                ));
			
			Session::flash('UserAdded', 'New User has been successfully added.');
			Redirect::to('admin.php?action=userList');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		} else {
            foreach ($validate->errors() as $error) {
				Session::flash('Error', $error);
				Redirect::to('admin.php?action=userList');
            }
        }
}
ob_end_flush();