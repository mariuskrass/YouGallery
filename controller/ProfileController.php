<?php

require_once('../repository/UserRepository.php');
require_once('../repository/UserFollowsUserRepository.php');

/**
 * Siehe Dokumentation im DefaultController.
 */
class ProfileController
{
    public function index()
    {
        $userRepository = new UserRepository();
    
        $userId = $_GET['userId'];
    	$view = new View('profile');
    	$view->title = 'Profil';
		$view->heading = '';
        $view->profile = $userRepository->readProfile($userId);
    	$view->display();
    }

    public function follow()
    {
        $userRepository = new UserRepository();
        $userFollowsUserRepository = new userFollowsUserRepository();

        session_start();
        $userId1 = htmlspecialchars($_SESSION['user_id']);
        $userId2 = htmlspecialchars($_GET['userId']);
        $userFollowsUserRepository->follow($userId1, $userId2);

        header("Location: /profile?userId=$userId2");
        die();
    }
}
