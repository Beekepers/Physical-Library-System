<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
            $programType = new ProgramType();

            try {
                $programType->create(array(
                    'type' => Input::get('type'),
                ));
			
			Session::flash('ProgramTypeAdded', 'New Program has been successfully added.');
			Redirect::to('admin.php?action=listProgramType');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();