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
    	$view->display();
    }

    public function upload()
    {
    	$uploaddir = '/var/www/uploads/';
		$uploadfile = $uploaddir . addslashes(time()) . basename($_FILES['userfile']['name']);
		$filename = addslashes(time()) . basename($_FILES['userfile']['name']);
    	
    	echo '<pre>';
    	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    		echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
    	} else {
    		echo "Möglicherweise eine Dateiupload-Attacke!\n";
    	}
    	
    	echo 'Weitere Debugging Informationen:';
    	print_r($_FILES);
    	
    	print "</pre>";
    	
        $pictureRepository = new PictureRepository();
        
        $pictureRepository->upload($filename);
        
        
    }
}
