<?php

require_once 'core/init.php';

$student = new Students(); //Current

$studentID = $_GET['studentID'];

$student = DB:: getInstance()->get('students', array('studentID','=',$studentID));
$count = DB:: getInstance()->count($student);

if($count<1){
	echo "<p class='text-success'>This Student ID is available.</p>";
}else{
	echo "<p class='text-danger'>This Student ID is already registered.</p>";
}