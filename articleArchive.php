<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Article Archive</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
	<style>
	blockquote {  
		border-style: solid;
		border-width: 5px;
		font-size: 15px;
		font-style: italic;
		border-color: #eee #17b978;
		border-left: 5px solid #17b978;
		padding:20px;
	}
	</style>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			
			<?php include 'includes/top-header.php'; ?>
			<!--  -->
			<?php include 'includes/wrap-main-nav.php'; ?>	
		</div>
	</header>

	<!-- Breadcrumb -->
	<div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="index.php" class="breadcrumb-item f1-s-3 cl9">
					Home 
				</a>

				<span class="breadcrumb-item f1-s-3 cl9">
					Article Archive
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			Article Archive
		</h2>
	</div>
	
	<section class="bg0">
		<div class="container">
			<div class="row m-rl--1">
				<?php	
                    $article = DB:: getInstance()->query("SELECT * FROM articles LIMIT 1");							
                    foreach($article->results() as $article){?>
						<div class="col-md-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url(admin/uploads/articleImage/<?php echo $article->article_image; ?>);">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									<?php
									$category = DB:: getInstance()->query("SELECT * FROM category WHERE id=$article->article_category");							
									foreach($category->results() as $category){?>
										<a href="categoryList.php?id=<?php echo $category->id; ?>" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
											<?php echo $category->category;?>
										</a>
									<?php }?>

									<h3 class="how1-child2 m-t-14 m-b-10">
										<a href="viewArticle.php?id=<?php echo $article->id;?>" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
											<?php echo $article->article_title; ?>
										</a>
									</h3>

									<span class="how1-child2">
										<span class="f1-s-4 cl11">
											Date Published
										</span>

										<span class="f1-s-3 cl11 m-rl-3">
											-
										</span>

										<span class="f1-s-3 cl11">
											<?php echo date("M d, Y", strtotime($article->date_published)); ?>
										</span>
									</span>
								</div>
							</div>
						</div>
				<?php }?>
				<div class="col-md-6 p-rl-1">
					<div class="row m-rl--1">
						<?php	
						$article = DB:: getInstance()->query("SELECT * FROM articles LIMIT 1,4");							
						foreach($article->results() as $article){?>
							<div class="col-sm-6 p-rl-1 p-b-2">
								<div class="bg-img1 size-a-14 how1 pos-relative" style="background-image: url(admin/uploads/articleImage/<?php echo $article->article_image; ?>);">
									<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

									<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
										<?php
										$category = DB:: getInstance()->query("SELECT * FROM category WHERE id=$article->article_category");							
										foreach($category->results() as $category){?>
											<a href="categoryList.php?id=<?php echo $category->id; ?>" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
												<?php echo $category->category;?>
											</a>
										<?php }?>

										<h3 class="how1-child2 m-t-14">
											<a href="viewArticle.php?id=<?php echo $article->id;?>" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
												<?php echo $article->article_title; ?>
											</a>
										</h3>
									</div>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="bg0 p-t-70 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-80">
					<div class="row">
						<?php	
						$article = DB:: getInstance()->query("SELECT * FROM articles");							
						foreach($article->results() as $article){?>
							<div class="col-sm-6 p-r-25 p-r-15-sr991">
								<!-- Item latest -->	
								<div class="m-b-45">
									<a href="viewArticle.php?id=<?php echo $article->id;?>" class="wrap-pic-w hov1 trans-03">
										<img src="admin/uploads/articleImage/<?php echo $article->article_image; ?>" alt="IMG">
									</a>

									<div class="p-t-16">
										<h5 class="p-b-5">
											<a href="viewArticle.php?id=<?php echo $article->id;?>" class="f1-m-3 cl2 hov-cl10 trans-03">
												<?php echo $article->article_title; ?>
											</a>
										</h5>

										<span class="cl8">
											<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
												Date Published
											</a>

											<span class="f1-s-3 m-rl-3">
												-
											</span>

											<span class="f1-s-3">
												<?php echo date("M d, Y", strtotime($article->date_published)); ?>
											</span>
										</span>
									</div>
								</div>
							</div>
						<?php }?>
					</div>
				</div>

				<div class="col-md-10 col-lg-4 p-b-80">
					<div class="p-l-10 p-rl-0-sr991">							

						<!-- Most Popular -->
						<div class="p-b-23">
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									Most Popular
								</h3>
							</div>

							<ul class="p-t-35">
								<?php 
								$articles = DB:: getInstance()->query("SELECT * FROM articles ORDER BY views DESC LIMIT 5");	
								foreach($articles->results() as $articles){?>
									<li class="flex-wr-sb-s p-b-22">
										<div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
										</div>

										<a href="viewArticle.php?id=<?php echo $articles->id;?>" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
											<?php echo $articles->article_title;?>
										</a>
									</li>
								<?php }?>
							</ul>
						</div>
						
						<!-- Tag -->
						<div>
							<div class="how2 how2-cl4 flex-s-c m-b-30">
								<h3 class="f1-m-2 cl3 tab01-title">
									Tags
								</h3>
							</div>

							<div class="flex-wr-s-s m-rl--5">
								<?php
								$category = DB:: getInstance()->query("SELECT * FROM category");		
								foreach($category->results() as $category){?>
									<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
										<?php echo $category->category;?>
									</a>
								<?php }?>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Footer -->
	<?php include 'includes/footer.html'; ?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- DATA TABES SCRIPT -->
	<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>