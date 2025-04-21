<?php

require 'core/init.php';
$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}else{
	if($user->isSuperAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listArticles':	
				require('admin/listArticles.php');
			break;
			case 'addArticle':	
				require('admin/addArticle.php');
			break;
			case 'editArticle':	
				require('admin/editArticle.php');
			break;
			case 'listCategory':	
				require('admin/listCategory.php');
			break;
			case 'editCategory':	
				require('admin/editCategory.php');
			break;
			case 'listTopics':	
				require('admin/listTopics.php');
			break;
			case 'editTopic':	
				require('admin/editTopic.php');
			break;
			case 'listContents':	
				require('admin/listContents.php');
			break;
			case 'editTopicContent':	
				require('admin/editTopicContent.php');
			break;
			case 'startAttendance':	
				require('admin/startAttendance.php');
			break;
			case 'attendance':	
				require('admin/attendance.php');
			break;
			case 'attendanceReport':	
				require('admin/attendanceReport.php');
			break;
			case 'listClass':	
				require('admin/listClass.php');
			break;
			case 'editClassInfo':	
				require('admin/editClassInfo.php');
			break;
			case 'listStudents':	
				require('admin/listStudents.php');
			break;
			case 'editStudentInfo':	
				require('admin/editStudentInfo.php');
			break;
			case 'listTrainees':	
				require('admin/listTrainees.php');
			break;
			case 'editTrainees':	
				require('admin/editTrainees.php');
			break;
			case 'listRequirements':	
				require('admin/listRequirements.php');
			break;
			case 'editRequirement':	
				require('admin/editRequirement.php');
			break;
			case 'listPrograms':	
				require('admin/listPrograms.php');
			break;
			case 'editProgram':	
				require('admin/editProgram.php');
			break;
			case 'listProgramType':	
				require('admin/listProgramType.php');
			break;
			case 'editProgramType':	
				require('admin/editProgramType.php');
			break;
			case 'startLibrarySystem':	
				require('admin/startLibrarySystem.php');
			break;
			case 'borrowBooks':	
				require('admin/borrowBooks.php');
			break;
			case 'returnBooks':	
				require('admin/returnBooks.php');
			break;
			case 'transactionHistory':	
				require('admin/transactionHistory.php');
			break;
			case 'listBooks':	
				require('admin/listBooks.php');
			break;
			case 'editBooks':	
				require('admin/editBooks.php');
			break;
			case 'listResearch':	
				require('admin/listResearch.php');
			break;
			case 'editResearch':	
				require('admin/editResearch.php');
			break;
			case 'listExtension':	
				require('admin/listExtension.php');
			break;
			case 'editExtension':	
				require('admin/editExtension.php');
			break;
			case 'userList':	
				require('admin/userList.php');
			break;
			case 'addUser':	
				require('admin/addUser.php');
			break;
			case 'editUser':	
				require('admin/editUser.php');
			break;
			
		  default:
			require('admin/dashboard.php');
		}
	}elseif($user->isQaAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listPrograms':	
				require('admin/listPrograms.php');
			break;
			case 'editProgram':	
				require('admin/editProgram.php');
			break;
			case 'listProgramType':	
				require('admin/listProgramType.php');
			break;
			case 'editProgramType':	
				require('admin/editProgramType.php');
			break;
			
		  default:
			require('admin/qadashboard.php');
		}
	}elseif($user->isElAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listTopics':	
				require('admin/listTopics.php');
			break;
			case 'editTopic':	
				require('admin/editTopic.php');
			break;
			case 'listContents':	
				require('admin/listContents.php');
			break;
			case 'editTopicContent':	
				require('admin/editTopicContent.php');
			break;
			
		  default:
			require('admin/eldashboard.php');
		}
	}elseif($user->isTeacher()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'startAttendance':	
				require('admin/startAttendance.php');
			break;
			case 'attendanceReport':	
				require('admin/attendanceReport.php');
			break;
			case 'attendance':	
				require('admin/attendance.php');
			break;
			case 'listClass':	
				require('admin/listClass.php');
			break;
			case 'editClassInfo':	
				require('admin/editClassInfo.php');
			break;
			case 'listStudents':	
				require('admin/listStudents.php');
			break;
			case 'editStudentInfo':	
				require('admin/editStudentInfo.php');
			break;
			
		  default:
			require('admin/tdashboard.php');
		}
	}elseif($user->isOjtAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listTrainees':	
				require('admin/listTrainees.php');
			break;
			case 'editTrainees':	
				require('admin/editTrainees.php');
			break;
			case 'listRequirements':	
				require('admin/listRequirements.php');
			break;
			case 'editRequirement':	
				require('admin/editRequirement.php');
			break;
			case 'messages':	
				require('admin/messages.php');
			break;
			
		  default:
			require('admin/ojtdashboard.php');
		}
	}elseif($user->isLibraryAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'startLibrarySystem':	
				require('admin/startLibrarySystem.php');
			break;
			case 'borrowBooks':	
				require('admin/borrowBooks.php');
			break;
			case 'returnBooks':	
				require('admin/returnBooks.php');
			break;
			case 'transactionHistory':	
				require('admin/transactionHistory.php');
			break;
			case 'listBooks':	
				require('admin/listBooks.php');
			break;
			case 'editBooks':	
				require('admin/editBooks.php');
			break;
			
		  default:
			require('admin/ldashboard.php');
		}
	}elseif($user->isResearchAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listResearch':	
				require('admin/listResearch.php');
			break;
			case 'editResearch':	
				require('admin/editResearch.php');
			break;
			
		  default:
			require('admin/listResearch.php');
		}
	}elseif($user->isExtensionAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		include "qrLib/qrlib.php";    
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listExtension':	
				require('admin/listExtension.php');
			break;
			case 'editExtension':	
				require('admin/editExtension.php');
			break;
			
		  default:
			require('admin/listExtension.php');
		}
	}else{
		Redirect::to('index.php');
	}
	
}
?>