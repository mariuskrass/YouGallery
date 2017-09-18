<?php

/**
 * Siehe Dokumentation im DefaultController.
 */
class FeedController
{
    public function index()
    {
        // Anfrage an die URI /user/crate weiterleiten (HTTP 302)
        $view = new View('feed');
        $view->title = 'Feed';
        $view->heading = 'Feed';
        $view->error = false;
        $view->id = null;
        $view->display();
    }

}
