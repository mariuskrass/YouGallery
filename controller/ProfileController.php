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
		$view->heading = 'Profil';
        $view->error = false;
        $view->profile = $userRepository->readProfile($userId);
    	$view->display();
    }

    public function follow()
    {
        $userFollowsUserRepository = new userFollowsUserRepository();

        session_start();
        $userId1 = $_SESSION['user_id'];
        $userId2 = $_GET['userId'];
        $view = new View('profile');
    	$view->title = 'Profil';
		$view->heading = 'Profil';
        $userId1 === $userId2 ? $view->error = true : $view->error = false && $userFollowsUserRepository->follow($userId1, $userId2);
        $view->profile = $userRepository->readProfile($userId1);
        $view->display();
    }
}
