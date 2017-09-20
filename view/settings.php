<?php
if($_SESSION['besucht'] != true){
    echo("Failed to login!");
    header("Location: /login");
    die();
}
$function = "/profile/user/";
?>

<div id="profile">
    <img id="profilbild" src="images/profile.png" width="100px">
    <div id="content">
        <h3 class="name"><?php echo $profile->username;?></h3><br><br>
        <p class="status"><?php echo $profile->status;?></p>
        <p style="font-weight: bold;">Ändere deinen Status oder dein Profilbild hier</p>
    </div>
    <div id="floatright">
        <div id="followbutton">
            <form action="<?=$function?><?=$profile->userId?>" method="GET" id="form">
                <input type="submit" class="btn btn-default <?=$bearbeiten?>" value="Speichern" id="follow">
            </form>
        </div>
    </div>
</div>
<br>
<hr id="line">
<div>
    <form enctype="multipart/form-data" action="/picture/upload" method="POST">
    <h3><strong>Ändere dein Profilbild:</strong></h3>
        <!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" class="btn btn-default"/>
        <!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
        Diese Datei hochladen: <input name="userfile" type="file" accept="image/*" class="btn btn-default" /><br>

    </form>
    <hr id="line">
    <form>
        <h3><strong>Ändere deine Status hier:</strong></h3>
        <h4 style="display: inline;">Status: </h4><input type="text" value="<?=$profile->status?>" placeholder="Status" style="border: none; border-bottom: 1px solid #FFB2B2; width: 25em; line-height: 2em;" id="input_status"><br>
    </form>
</div>
