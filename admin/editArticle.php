<?php
if (Input::exists()) {
		$article = new Articles();
			try {
				$article->update(array(
					'article_title' => Input::get('title'),
                    'article_category' => Input::get('category'),
					'article_content' => Input::get('content'),
				), $_GET['id']);
				Session::flash('Updated', 'Content Info has been successfully updated.');
				Redirect::to('admin.php?action=listArticles');
			} catch(Exception $e) {
				$error;
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
                        Topic Content Info
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=listContents">Content Lists</a></li>
                        <li class="active">Edit Topic Content</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Topic Content- <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<?php if(Session::exists('NewFile')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('NewFile'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$article = DB:: getInstance()->query("SELECT * FROM articles WHERE id=".$_GET['id']."");							
									foreach($article->results() as $article){
									?>
								
										<form enctype="multipart/form-data" method="post" action="">
											<div class="row">
												<div class="col-lg-4 col-md-4">
													<label class="control-label" for="category"><font color="#EC0003">*</font> Topics:</label>
													<div class="form-group">
														<select class="form-control" name="category" id="category">
															<option value="">Select Topic</option>
															<?php
																$category = DB:: getInstance()->query("SELECT * FROM category");							
																foreach($category->results() as $category){
																if ($category->id == $article->article_category){
																	$selected = 'selected';
																}else{
																	$selected = '';;
																}
															?>
															<option value="<?php echo $category->id;?>" <?php echo $selected; ?>><?php echo ucwords($category->category); ?></option>
															<?php }?>
														</select>
													</div>
												</div>
												<div class="col-lg-4 col-md-4">
													<label class="control-label" for="title"><font color="#EC0003">*</font> Article Title</label>
													<div class="form-group">
														<input type="text" class="form-control" id="title" name="title" value="<?php echo $article->article_title; ?>" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-9 col-md-9">
													<label class="control-label" for="content"><font color="#EC0003">*</font> Details</label>
													<div class="form-group">
														<textarea id="content" name="content" rows="10" cols="80">
															<?php echo $article->article_content; ?>
														</textarea>  
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5 col-md-5">
													<button type="button" class="btn btn-success" data-toggle="modal" data-target="#upload">
														View or Edit Image
													</button>
												</div>		
											</div>
											
											<div class="clearfix"></div><hr />
											<div class="form-actions">
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
												</button>
												<button type="button" class="btn btn" onclick="window.location='admin.php?action=listArticles'">Cancel</button>
											</div>
										</form>	
										<!-- Modal -->
													<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">View or Upload New Image</h3>
														</div>
														<div class="modal-body">
															<center>
																<img width="70%" src="admin/uploads/articleImage/<?php echo $article->article_image; ?>" ><hr>
															</center>
															<form enctype="multipart/form-data" method="post" action="editArticleImage.php">
																<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload New Article Image</label>
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
																<input type="hidden" name="newfile" value="<?php echo $article->id; ?>">.
																<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Upload Photo</button>
															</form>
														</div>
														<div class="modal-footer">
															
															<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
														</div>
														</div>
													</div>
													</div>
										
								<?php }?>                 
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
        CKEDITOR.replace('content');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>
</body>
</html>