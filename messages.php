<?php
/**
 * Created by Chris on 9/29/2014 3:52 PM.
 */

require_once 'core/init.php';

$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
	Redirect::to('login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Messages</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<!--===============================================================================================-->
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
					Messages
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2" style="text-align:left">
			Messages
		</h2>
	</div>

	<!-- Content -->
		
									<div class="chat">	
										<div id="frame">		
											<div id="sidepanel">
												<div id="profile">
													<div class="wrap">
														<?php
														$chat = new Chat();
														$loggedUser = $chat->getUserDetails($user->data()->id);
														$currentSession = '';
														foreach ($loggedUser as $loggedUser) {
															$currentSession = $loggedUser['current_session'];
															if ($loggedUser['avatar'] == ''){?>
																<img id="profile-img" src="admin/uploads/avatar/default.jpg ?>" class="online" alt="" />
															<?php }else{?>
																<img id="profile-img" src="admin/uploads/avatar/<?php echo $loggedUser['avatar']; ?>" class="online" alt="" />
															<?php }?>
															<p><?php echo $loggedUser['username']?></p>
															<div id="status-options">
																<ul>
																	<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
																	<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
																	<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
																	<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
																</ul>
															</div>
														<?php } ?>
													</div>
												</div>
												<hr>
												<div id="contacts">	
													<ul>
														<?php
														$user = new UserLogin();
														$chatUsers = $chat->chatCoordinator($user->data()->id);
														foreach ($chatUsers as $chatUser) {
															$status = 'offline';						
															if($chatUser['online']) {
																$status = 'online';
															}
															$activeUser = '';
															if($chatUser['id'] == $currentSession) {
																$activeUser = "active";
															}?>
															<li id="<?php echo $chatUser['id']; ?>" class="contact <?php echo $activeUse?>" data-touserid="<?php echo $chatUser['id']?>" data-tousername="<?php echo $chatUser['username']; ?>">
																<div class="wrap">
																	<span id="status_<?php echo $chatUser['id']; ?>" class="contact-status <?php echo $status; ?>"></span>
																	<?php if ($chatUser['avatar'] == ''){?>
																		<img src="admin/uploads/avatar/default.jpg" alt="" />
																	<?php }else{?>
																		<img src="admin/uploads/avatar/<?php echo $chatUser['avatar']; ?>" alt="" />
																	<?php }?>
																	<div class="meta">
																		<p class="name">
																			<?php echo $chatUser['username']; ?><span id="unread_<?php echo $chatUser['id']?>" class="unread"><?php echo $chat->getUnreadMessageCount($chatUser['id'], $user->data()->id);?></span>
																		</p>
																		<p class="preview"><span id="isTyping_<?php echo $chatUser['id']; ?>" class="isTyping"></span></p>
																	</div>
																</div>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>			
											<div class="content" id="content"> 
												<div class="contact-profile" id="userSection">	
												<?php
												$userDetails = $chat->getUserDetails($currentSession);
												foreach ($userDetails as $userDetails) {?>	
													<?php if ($userDetails['avatar'] == ''){?>
														<img src="admin/uploads/avatar/default.jpg" alt="" />
													<?php }else{?>
														<img src="admin/uploads/avatar/<?php echo $userDetails['avatar']; ?>" alt="" />
													<?php }?>
														<p><?php echo $userDetails['username']; ?></p>
												<?php }	?>						
												</div>
												<div class="messages" id="conversation">		
													<?php echo $chat->getUserChat($user->data()->id, $currentSession); ?>
												</div>
												<div class="message-input" id="replySection">				
													<div class="message-input" id="replyContainer">
														<div class="wrap">
															<input type="text" class="chatMessage" id="chatMessage<?php echo $currentSession; ?>" placeholder="Write your message..." />
															<button class="submit chatButton" id="chatButton<?php echo $currentSession; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>	
														</div>
													</div>					
												</div>
											</div>
										</div>
									</div>
			
				
				
	<!-- Footer -->
	<?php include 'includes/footer.html'; ?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>


<!--===============================================================================================-->	
	<script src="js/jquery.min.js"></script>
	<script src="js/chat.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>