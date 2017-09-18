<?php
require_once '../repository/createUserRepository.php';
/**
 * Siehe Dokumentation im DefaultController.
 */
class LoginController
{
    public function index()
    {
        // Anfrage an die URI /user/crate weiterleiten (HTTP 302)
        $view = new View('login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->error = false;
        $view->display();
    }

    public function doLogin(){
		$error = false;
		$userRepository = new createUserRepository();
		$benutzername = $_POST['benutzername'];
		$passwort = sha1($_POST['passwort']);
		
		foreach($userRepository->readAll() as $user){
			if($user->username == $benutzername){
				if($user->password == $passwort){
					$_SESSION['logged_in_user'] = $user->id;
					$error = false;
				}
				else{
					$error = true;
				}
			}
			else{
				$error = true;
			}	
		}
	

		if($error){
			$view = new View('login');
			$view->title = 'Login';
			$view->heading = 'Login';
			$view->error = $error;
			$view->display();
		}
		else{
			$view = new View('feed');
			$view->title = 'Feed';
			$view->heading = 'Feed';
			$view->error = $error;
			$view->display();
		}
	}

}
