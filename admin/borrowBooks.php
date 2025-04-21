<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current
	
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
			$books = DB::getInstance()->get('books', array('isbn','=',Input::get('qrcode')));
			if ($books->count()){
				foreach($books->results() as $books){
					$book = new Books();
					 try {
						$book->update(array(
							'is_borrowed' => 1,
							'borrowerID' => Input::get('borrowerID'),
							'borrower' => Input::get('borrower'),
							'borrowerContact' => Input::get('borrowerContact'),
							'dateBorrowed' => date('m/d/Y'),
						),$books->id);
					} catch(Exception $e) {
					   $error;
					}
				}
			}
			
			$booktransaction = new BookTransactions();
            try {
                $booktransaction->create(array(
					'transactionType' => 'borrow',
					'transactionDate' => date('m/d/Y'),
					'transactionTime' => date('H:i:s'),
					'isbn' => Input::get('qrcode'),
					'bookTitle' => Input::get('bookTitle'),
					'borrowerID' => Input::get('borrowerID'),
					'borrower' => Input::get('borrower'),
                ));
			
			Session::flash('Borrowed', 'New Book has been borrowed.');
			Redirect::to('admin.php?action=startLibrarySystem');
            } catch(Exception $e) {
               $error;
            }
    }
}


	
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>SDSSU Cantilan Campus</title>
<style>
.video-box {
	margin: auto;
	width:90%;
	border:10px solid #dcdcdc;
	background-color: #dcdcdc;
}
.btn-huge{
	width:100%;
    padding:20px;
	margin-bottom:5px;
}
</style>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Library Management System
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Library Management System - Borrow Books</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-book"></i>  Borrow Books</h3>                           
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="row">
										<form enctype="multipart/form-data" method="post" action="" >
											<div class="row">
												<div class="col-xs-5">
													<div class="row">
														<div class="col-xs-12">
															<div class="video-box">
																<video width="100%" id="preview"></video>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<span id="msg" name="msg">
															</span>
														</div>
													</div>
												</div>
												<div class="col-xs-7">
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="qrcode">ISBN</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="qrcode" name="qrcode" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="bookTitle">Title of the Book</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="bookTitle" name="bookTitle" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="author">Author</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="author" name="author" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="datePublished">Date Published</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="datePublished" name="datePublished" readonly>
															</div>
														</div>
													</div>
													
													<div class="row">
														<div class="col-xs-12">
															<h3>Input Borrower Info</h3>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="borrowerID">ID Number</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="borrowerID" name="borrowerID" placeholder="Input ID Number" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="borrower">Student Name or Borrowers Name</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="borrower" name="borrower" placeholder="Input Name" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-2">
															<label class="control-label" for="borrowerContact">Borrowers Contact #</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="borrowerContact" name="borrowerContact" placeholder="Input Phone Number" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
															<button type="submit" class="btn btn-info btn-lg btn-huge" style="display:none;" name="transact" id="transact">BORROW BOOK</button>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<a href="admin.php?action=startLibrarySystem" type="button" class="btn btn-danger btn-lg btn-huge">CANCEL</a>
														</div>
													</div>
												</div>
											</div>
											<hr>
										</form>
									</div>
								</div><!-- /.box -->
								
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
	
	<script src="js/jquery3.3.1.min.js"></script>
	<script src="js/instascan.min.js"></script>
	<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
		var isbn = content;
			$.ajax({
				type: "POST",
				url: "borrow.php",
				dataType: "json",
				data: {isbn:isbn, action:'view_book_info'},
				success : function(data){
					$("#qrcode").val(data.id);
					$("#bookTitle").val(data.bookTitle);
					$("#author").val(data.author);
					$("#datePublished").val(data.datePublished);
					$("#msg").html(data.msg);
					if (data.id == '') {
						document.getElementById("transact").style.display = "none";
					}else{
						document.getElementById("transact").style.display = "block";
					}
				}
			});
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
</body>
</html>

