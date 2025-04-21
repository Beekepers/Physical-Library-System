<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
            $category = new Category();

            try {
                $category->create(array(
                    'category' => Input::get('category'),
                ));
			
			Session::flash('Added', 'New Category has been successfully added.');
			Redirect::to('admin.php?action=listCategory');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();