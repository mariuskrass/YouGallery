<?php

require_once('../repository/PictureRepository.php');

/**
 * Siehe Dokumentation im DefaultController.
 */
class FeedController
{
    public function index()
    {
        $pictureRepository = new PictureRepository();

        $view = new View('feed');
        $view->title = 'Feed';
        $view->heading = 'Feed';
        $view->error = false;
        $view->pictures = $pictureRepository->readAllWithUserName();
        $view->display();
    }
}
