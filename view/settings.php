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
    </div>
    <div id="floatright">
        <div id="followbutton">
            <form action="<?=$function?><?=$profile->userId?>" method="GET" id="form">
                <input type="submit" class="btn btn-default <?=$bearbeiten?>" value="Speichern" id="follow">
            </form>
        </div>
        <div id="followcount">
            <h3 id="count_follower"><?php echo $profile->followersCount;?> Follower</h3>
        </div>
    </div>
</div>
<br>
<hr id="line">
