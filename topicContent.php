<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
    Redirect::to('elearning-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>E-Learning</title>
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
					E-Learning 
				</a>
				
				<a href="topicList.php" class="breadcrumb-item f1-s-3 cl9">
					Topic List 
				</a>
				<?php
				$content = DB:: getInstance()->query("SELECT * FROM topic_contents WHERE id=".$_GET['id']."");							
				foreach($content->results() as $content){?>
					<span class="breadcrumb-item f1-s-3 cl9">
						<?php echo $content->chapterTitle;?>
					</span>
				<?php }?>
			</div>
		</div>
	</div>

	<!-- Post -->
	<section class="bg0 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-12 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<!-- Blog Detail -->
						<?php
							$content = DB:: getInstance()->query("SELECT * FROM topic_contents WHERE id=".$_GET['id']."");							
							foreach($content->results() as $content){?>
						<div class="p-b-70">
							<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
								<?php echo $content->chapterTitle;?>
							</h3>
							
							<?php echo $content->content;?>
							
							<!-- Tag -->
							<div class="flex-s-s p-t-12 p-b-15">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
									Download Attachment:
								</span>
								
								<div class="flex-wr-s-s size-w-0">
									<a href="admin/uploads/topic_contents/<?php echo $content->attached_file; ?>" target="_blank" class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
										<i class="fa fa-floppy-o m-r-7"></i>
										Download
									</a>
								</div>
							</div>
														
						</div>

						<?php }?>
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