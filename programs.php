<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Programs Offered</title>
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
					Programs Offered
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			PROGRAMS OFFERED
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Graduate Studies / Undergraduate</th>
                                                <th>Academic Programs</th>
												<th>Level of Accreditation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$programs = DB:: getInstance()->query("SELECT * FROM programs");							
												foreach($programs->results() as $programs){
													$programType = DB:: getInstance()->query("SELECT * FROM programtype WHERE id = '$programs->programType'");							
													foreach($programType->results() as $programType){	?>
														<tr>
														
															<td><?php echo $programType->type ; ?></td>
															<td><?php echo $programs->programs ; ?></td>
															<td><?php echo $programs->accLevel.' '.$programs->accPhase; ?></td>
														</tr>
                                            <?php 	
													}
												}
												?>
                                        </tbody>
                                    </table>
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