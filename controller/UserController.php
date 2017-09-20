<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
    	$view = new View('user_create');
    	$view->title = 'Registrieren';
		$view->heading = 'Registrieren';
		$view->error = false;
    	$view->display();
    }

    public function create()
    {
    	$userRepository = new UserRepository();
    	$benutzername = htmlspecialchars($_POST["benutzername"]);
    	$passwort = htmlspecialchars($_POST["passwort"]);
		$email = htmlspecialchars($_POST["email"]);
		$status = "I'm new on YouGallery";
		$error = false;
		foreach($userRepository->readAll() as $user){
			if($user->username == $benutzername || strlen($benutzername) > 25 || strlen($benutzername) == 0){
				$error = true;
			}
			if(strlen($passwort) == 0){
				$error = true;
			}
			else{
				if($user->email == $email || strlen($email) == 0){
					$error = true;
				}
				else{
					$error = false;
				}
			}
		}

		if ($error){
			//Error
			$view = new View('user_create');
			$view->title = 'Registrieren';
			$view->heading = 'Registrieren';
			$view->error = $error;
			$view->display();
		}else{
			$userRepository->create($benutzername, $passwort, $email, $status);

			$view = new View('login');
			$view->title = 'Login';
			$view->heading = 'Login';
			$view->error = false;
			$view->display();
		}


		
	}
	
	
	





	

	
}
