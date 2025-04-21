<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

$uname = $_GET['uname'];

$user = DB:: getInstance()->get('userlogin', array('username','=',$uname));
$count = DB:: getInstance()->count($user);

if($count<1){
	echo "<p class='text-success'>This username is available.</p>";
}else{
	echo "<p class='text-danger'>This username is unavailable.</p>";
}