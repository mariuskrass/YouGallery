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
    	$benutzername = $_POST["benutzername"];
    	$passwort = $_POST["passwort"];
		$email = $_POST["email"];
		$status = "I'm new on YouGallery";
		$error = false;
		foreach($userRepository->readAll() as $user){
			if($user->username == $benutzername){
				$error = true;
			}
			else{
				if($user->email == $email){
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
