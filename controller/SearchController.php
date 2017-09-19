<?php

require_once('../repository/UserRepository.php');

/**
 * Siehe Dokumentation im DefaultController.
 */
class SearchController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('search');
        $view->title = 'Suche';
        $view->heading = 'Suche';
        $view->result = $userRepository->readByKeyword($_GET['keyword']);
        $view->display();
    }
}
