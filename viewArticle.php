<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Article</title>
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
	p{
		padding-top:10px;
		padding-bottom:10px;
		text-align: justify;
		text-justify: inter-word;
		text-indent: 50px;
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
				
				<a href="articleArchive.php" class="breadcrumb-item f1-s-3 cl9">
					Article Archive
				</a>
				<?php
				$article = DB:: getInstance()->query("SELECT * FROM articles WHERE id=".$_GET['id']."");							
				foreach($article->results() as $article){
					$viewsCount = new Articles();
					if(isset($_GET['id'])){
						$viewsCount->update(array(
						'views' => $article->views + 1,
						),$_GET['id']);
					}?>
					<span class="breadcrumb-item f1-s-3 cl9">
						<?php echo $article->article_title;?>
					</span>
				<?php }?>
			</div>
		</div>
	</div>

	<!-- Post -->
	<section class="bg0 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<!-- Blog Detail -->
						<?php
							$article = DB:: getInstance()->query("SELECT * FROM articles WHERE id=".$_GET['id']."");							
							foreach($article->results() as $article){?>
						<div class="p-b-70">
							<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
								<?php echo $article->article_title;?>
							</h3>
							
							<div class="flex-wr-s-s p-b-40">
								<span class="f1-s-3 cl8 m-r-15">
									<i class="fa fa-eye"></i>
									<span>
										<?php echo $article->views;?>
									</span>
									<span class="m-rl-3">Views</span>
								</span>
								<span class="f1-s-3 cl8 m-r-15">
									<span class="m-rl-3">Date Added - </span>
									<span>
										<?php echo $article->date_published;?>
									</span>
								</span>
							</div>
							
							<div class="wrap-pic-max-w p-b-30">
								<img width="100%" src="admin/uploads/articleImage/<?php echo $article->article_image; ?>" alt="IMG">
							</div>
							
							<div class="flex-wr-s-s p-b-40">
								<?php echo $article->article_content;?>
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