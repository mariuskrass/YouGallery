<?php
require_once '../repository/UserRepository.php';
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
		$userRepository = new UserRepository();
		if(isset($_POST['benutzername']) && isset($_POST['passwort'])){
			$benutzername = htmlspecialchars($_POST['benutzername']);
			$passwort = htmlspecialchars(sha1($_POST['passwort']));
			if(strlen($benutzername) > 25 || strlen($benutzername) == 0  || strlen($passwort) == 0){
				$error = true;
			}
			else{
			

			foreach($userRepository->readAll() as $user){
				if($user->username == $benutzername){
					if($user->password == $passwort){
						session_start();
						$_SESSION['user_id'] = $user->id;
						$_SESSION['besucht'] = true;
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
			}

		}
		else {
			$error = true;
		}
		
	

		if($error){
			$view = new View('login');
			$view->title = 'Login';
			$view->heading = 'Login';
			$view->error = $error;
			$view->display();
		}
		else{
			header("Location: /feed");
			die();
		}
	}



}
