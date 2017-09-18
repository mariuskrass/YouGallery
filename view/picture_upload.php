<?php
    if($error){
        echo('<div class="alert alert-danger">Datei konnte nicht hochgeladen werden!</div>');
    }else{
        echo('<div class="alert alert-success">Datei wurde erfolgreich hochgeladen!</div>');
    }
?>
<form enctype="multipart/form-data" action="/picture/upload" method="POST">
    <!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
    Diese Datei hochladen: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>