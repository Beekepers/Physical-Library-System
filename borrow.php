<?php
require_once 'core/init.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_book_info':	
				$books = DB:: getInstance()->get('books', array('isbn','=',$_POST['isbn']));
				if ($books->count()){
					foreach($books->results() as $books){
						if ($books->is_borrowed == 1){
							$isbn = '';
							$bookTitle = '';
							$author = '';
							$datePublished = '';
							$msg = '<div class="alert alert-warning" >
									<i class="glyphicon glyphicon-ok"></i> This Book is not available. Please return it <a href="admin.php?action=returnBooks">here</a> so you can borrow it again.
								</div>';
						}else{
							$isbn = $books->isbn;
							$bookTitle = $books->bookTitle;
							$author = $books->author;
							$datePublished = $books->datePublished;
							$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> Record found!
								</div>';
						}
					}
					
				}else{
					$isbn = '';
					$bookTitle = '';
					$author = '';
					$datePublished = '';
					$msg = '<div class="alert alert-danger" >
								<i class="glyphicon glyphicon-remove"></i> No record found.
							</div>';
				}

				echo json_encode(['id'=>$isbn, 'bookTitle'=>$bookTitle, 'author'=>$author, 'datePublished'=>$datePublished, 'msg'=>$msg]);
			break;

		 default:
				;
		}
?>