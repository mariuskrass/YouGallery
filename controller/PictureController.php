<?php

require_once '../repository/PictureRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class PictureController
{
    public function index()
    {
    	$view = new View('picture_upload');
    	$view->title = 'Bild hochladen';
		$view->heading = 'Bild hochladen';
		$view->error = false;
    	$view->display();
    }

    public function upload()
    {
    	$uploaddir = '/var/www/uploads/';
		$uploadfile = $uploaddir . addslashes(time()) . basename($_FILES['userfile']['name']);
		$filename = addslashes(time()) . basename($_FILES['userfile']['name']);

    	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    		$error = false;
    	} else {
    		$error = true;
		}
    	
        $pictureRepository = new PictureRepository();
		
		if (!$error){
			$pictureRepository->doUpload($filename);
		}
		
		$view = new View('picture_upload');
		$view->title = 'Bild hochladen';
		$view->heading = 'Bild hochladen';
		$view->error = $error;
    	$view->display();
	}
}
