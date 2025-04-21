<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
		$classInfo = new ClassInfo();
            try {
                $classInfo->create(array(
					'teacher_id' => $user->data()->id,
					'course' => Input::get('course'),
                    'subject' => Input::get('subject'),
					'schedule' => Input::get('schedule'),
                ));
			
			Session::flash('Added', 'New Class has been successfully added.');
			Redirect::to('admin.php?action=listClass');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();