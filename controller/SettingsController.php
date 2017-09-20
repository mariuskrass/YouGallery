<?php


class SettingsController
{
  
    public function index()
    {

        $view = new View('settings');
        $view->title = 'Bearbeiten';
        $view->error = false;
        $view->display();
    }
}
