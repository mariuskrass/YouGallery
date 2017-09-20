<?php

require_once '../repository/UserRepository.php';

class SettingsController extends Repository
{
    public function index()
    {
        $userRepository = new UserRepository();

        session_start();
        $view = new View('settings');
        $view->title = 'Bearbeiten';
        $view->error = false;
        $view->profile = $userRepository->readSettingsProfile($_SESSION['user_id']);
        $view->display();
    }

    public function save(){
        $userRepository = new UserRepository();
        
        $id = htmlspecialchar($_POST['id']);
        $status = htmlspecialchar($_POST['status']);

        $userRepository->updateProfile($id, $status);

        header("Location: /profile?userId=$id");
        die();
    }

    public function upload(){
        $uploaddir = "../public/var/www/uploads/";
		$uploadfile = $uploaddir . addslashes(time()) . basename($_FILES['userfile']['name']);
		$filename = addslashes(time()) . basename($_FILES['userfile']['name']);
		if(strlen($filename) > 60){
			$error = true;
		}
		else{
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				$error = false;
			} else {
				$error = true;
			}
		}
    	
        $pictureRepository = new PictureRepository();
		
		if (!$error){
            // funktion
        }
    }
}
