<?php
require_once 'core/init.php';
$user = new UserLogin();
$chat = new Chat();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'update_user_list':	
				$chatUsers = $chat->chatUsers($user->data()->id);
				$data = array(
					"profileHTML" => $chatUsers,	
				);
				echo json_encode($data);
			break;
			
			case 'insert_chat':
				$chat->insertChat($_POST['to_user_id'], $user->data()->id, $_POST['chat_message']);
			break;
			
			case 'show_chat':
				$chat->showUserChat($user->data()->id, $_POST['to_user_id']);
			break;
			
			case 'update_user_chat':
				$conversation = $chat->getUserChat($user->data()->id, $_POST['to_user_id']);
				$data = array(
					"conversation" => $conversation			
				);
				echo json_encode($data);
			break;
			
			case 'update_unread_message':
				$count = $chat->getUnreadMessageCount($_POST['to_user_id'], $user->data()->id);
				$data = array(
					"count" => $count			
				);
				echo json_encode($data);
			break;
			
			case 'update_typing_status':
				$chat->updateTypingStatus($_POST['is_type'], $user->data()->id);
			break;
			
			case 'show_typing_status':
				$message = $chat->fetchIsTypeStatus($_POST['to_user_id']);
				$data = array(
					"message" => $message			
				);
				echo json_encode($data);
			break;
			
		  default:
				;
		}

?>