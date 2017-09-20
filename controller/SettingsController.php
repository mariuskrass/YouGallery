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
}
