<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
		$articles = new Articles();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/articleImage/"); 
			$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
            try {
                $articles->create(array(
					'article_category' => Input::get('article_category'),
					'article_title' => Input::get('article_title'),
					'article_content' => Input::get('article_content'),
					'article_image' => $image,
					'date_published' => date("F j, Y, g:i a"),
					'views' => 0,
                ));
			Session::flash('Added', 'New Article has been successfully added.');
			Redirect::to('admin.php?action=listArticles');
            } catch(Exception $e) {
                echo $e, '<br>';
            }
}
ob_end_flush();