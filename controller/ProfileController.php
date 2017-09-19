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
        $view->error = false;
        $view->profile = $userRepository->readProfile($userId);
    	$view->display();
    }

    public function follow()
    {
        $userRepository = new UserRepository();
        $userFollowsUserRepository = new userFollowsUserRepository();

        session_start();
        $userId1 = $_SESSION['user_id'];
        $userId2 = $_GET['userId'];
        $view = new View('profile');
    	$view->title = 'Profil';
		$view->heading = 'Profil';
        $view->error = $userFollowsUserRepository->follow($userId1, $userId2);
        $view->profile = $userRepository->readProfile($userId2);
        $view->display();
    }
}
