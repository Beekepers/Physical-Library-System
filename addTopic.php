<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
            $topic = new Topic();

            try {
                $topic->create(array(
                    'topicTitle' => Input::get('topic'),
                ));
			
			Session::flash('Added', 'New Program has been successfully added.');
			Redirect::to('admin.php?action=listTopics');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();