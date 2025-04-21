<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
			//set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'bookQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);
			
			$filename = '';
			
			//processing form input
			//remember to sanitize user input in real-life solution !!!
			$errorCorrectionLevel = 'H';
			$matrixPointSize = 10;

			if (isset($_REQUEST['isbn'])) { 
				// user data
				$newfilename = round(microtime(true)).'.png';
				$filename = $PNG_TEMP_DIR.$newfilename;
				QRcode::png($_REQUEST['isbn'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
				
			} 
			$books = new Books();
            try {
                $books->create(array(
					'isbn' => Input::get('isbn'),
					'bookTitle' => Input::get('bookTitle'),
					'author' => Input::get('author'),
					'datePublished' => Input::get('datePublished'),
					'qrcode' => $newfilename
                ));
			
			Session::flash('Added', 'New Book has been successfully added.');
			Redirect::to('admin.php?action=listBooks');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
}
ob_end_flush();