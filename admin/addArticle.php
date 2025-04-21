<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

if (Input::exists()) {
	if(Token::check(Input::get('token'))) {
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
		
		$addArticle = DB::getInstance()->insert('articles', array(
					'article_category' => Input::get('article_category'),
					'article_title' => Input::get('article_title'),
					'article_content' => Input::get('article_content'),
					'article_image' => $image,
					'date_published' => date("F j, Y, g:i a")
					));
			Session::flash('Added', 'New Article has been successfully added.');
			Redirect::to('admin.php?action=listArticles');
	}
}
ob_end_flush();
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
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<title>SDSSU Cantilan Campus</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Article
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=listArticles">Article Lists</a></li>
                        <li class="active">Add Article</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Add Article- <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
										<form enctype="multipart/form-data" method="post" action="">
											<div class="row">
												<div class="col-lg-4 col-md-4">
													<label class="control-label" for="category"><font color="#EC0003">*</font> Topics:</label>
													<div class="form-group">
														<select class="form-control" name="article_category" id="article_category" required>
															<option hidden value="">Select Topic</option>
															<?php
																$category = DB:: getInstance()->query("SELECT * FROM category");							
																foreach($category->results() as $category){
															?>
															<option value="<?php echo $category->id?>"><?php echo ucwords($category->category) ?></option>
															<?php }?>
														</select> 
													</div>
												</div>
												<div class="col-lg-4 col-md-4">
													<label class="control-label" for="title"><font color="#EC0003">*</font> Article Title</label>
													<div class="form-group">
														<input type="text" class="form-control" id="article_title" name="article_title" placeholder="Input Title" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5 col-md-5">
													<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload Content Image</label>
													<div class="form-group">
														<input type="file" id="fileName" name='upload' accept=".jpg,.jpeg,.png" onchange="validateFileType()" required>
													</div>
														<script type="text/javascript">
															function validateFileType(){
																var fileName = document.getElementById("fileName").value;
																var idxDot = fileName.lastIndexOf(".") + 1;
																var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
																if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
																	//TO DO
																}else{
																	alert("Only jpg/jpeg and png files are allowed!");
																}   
															}
														</script>
												</div>		
											</div>
											<div class="row">
												<div class="col-lg-9 col-md-9">
													<label class="control-label" for="article_content"><font color="#EC0003">*</font> Content</label>
													<div class="form-group">
														<textarea id="article_content" name="article_content" rows="10" cols="80">
														</textarea>  
													</div>
												</div>
											</div>
											<div class="clearfix"></div><hr />
											<div class="form-actions">
												<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
												</button>
												<button type="button" class="btn btn" onclick="window.location='admin.php?action=listArticles'">Cancel</button>
											</div>
										</form>	
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>

<!-- CK Editor -->
<script src="styles/admin/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('article_content');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>
</body>
</html>