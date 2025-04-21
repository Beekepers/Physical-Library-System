<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin();
$chat = new Chat();

$chat->updateUserOnline($user->data()->id, 0);
$chat->updateCurrentSession($user->data()->id, 0);
$_SESSION['username'] = "";
$_SESSION['userid']  = "";
$_SESSION['login_details_id']= "";

$user->logout();
Redirect::to('index.php');
ob_end_flush();