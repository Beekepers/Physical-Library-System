<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Procedures for OJT</title>
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
					Procedures for OJT
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			Procedures for OJT Application
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 p-b-30">
					<div class="p-r-10 p-r-0-sr991">						
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Step #</th>
                                    <th>Procedures for OJT Application</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Step 1</td>
									<td>Secure OJT Qualification Certificate duly signed by the registrar.</td>
								</tr>
								<tr>
									<td>Step 2</td>
									<td>Enroll OJT/Practicum.</td>
								</tr>
								<tr>
									<td>Step 3</td>
									<td>Attend Orientation Seminar to OJT/Practicumers with a parent or guardian and fill-up Students Information Sheet(SIS).</td>
								</tr>
								<tr>
									<td>Step 4</td>
									<td>Secure recommendation to undergo OJT/Practicum from the program chair.</td>
								</tr>
								<tr>
									<td>Step 5</td>
									<td>Present the Program chair’s recommendation to the OJT Placement Office where his/her attendance to OJT Orientation is confirmed.</td>
								</tr>
								<tr>
									<td>Step 6</td>
									<td>Secure trainees Police Clearance, Medical Certificate, Residence Certificate together with one of the parents or guardian.</td>
								</tr>
								<tr>
									<td>Step 7</td>
									<td>Present a photocopy of Certificate of Registration(COR) to the OJT Coordinator for the release of OJT documents.</td>
								</tr>
								<tr>
									<td>Step 8</td>
									<td>Accomplish OJT/Practicum documents.</td>
								</tr>
								<tr>
									<td>Step 9</td>
									<td>Return accomplished OJT/Practicum documents to OJT coordinator for final decision.</td>
								</tr>
								<tr>
									<td>Step 10</td>
									<td>Present complete name and address of establishment or company on where to undergo OJT.</td>
								</tr>
								<tr>
									<td>Step 11</td>
									<td>Secure endorsement paper from the OJT coordinator and leave one seat of duly signed accomplished OJT documents at the OJT Office.</td>
								</tr>
								</tbody>
						</table>
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