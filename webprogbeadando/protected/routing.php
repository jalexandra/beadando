
<?php
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'home';

switch ($_GET['P']) {
	case 'home': require_once PROTECTED_DIR.'normal/home.php'; break;
	case 'test': require_once PROTECTED_DIR.'normal/permission_test.php'; break;


	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;

	case 'register': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;

	case 'profile': IsUserLoggedIn() ? require_once PROTECTED_DIR.'workers/profile.php' : header('Location: index.php'); break;
	
	case 'update': IsUserLoggedIn() ? require_once PROTECTED_DIR.'workers/update.php' : header('Location: index.php'); break;
	
	case 'list_workers': IsUserLoggedIn() ? require_once PROTECTED_DIR.'workers/list.php' : header('Location: index.php'); break;
	
	case 'add_worker': IsUserLoggedIn() ? require_once PROTECTED_DIR.'workers/add.php' : header('Location: index.php'); break;
	
	case 'list_company': IsUserLoggedIn() ? require_once PROTECTED_DIR.'company/list.php' : header('Location: index.php'); break;

	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;



	default: require_once PROTECTED_DIR.'normal/404.php'; break;
}

?>
