<?php 
session_start();
if($_SESSION['besucht'] == true){
    echo("Logged in");
}
else{
    echo("Failed to login!");
    header("Location: /login");
    die();
}


foreach($pictures as $picture) :?>

<div id="feed">
    <div class="feed-element">
        <div class="feed-header">
            <img class="feed-profilbild" src='/var/www/uploads/<?php echo $picture->name ?>'>
            <h3 class="feed-username"><?php echo $profile->username;?></h3>
        </div>
        <img src="images/profile.png" class="feed-photo">
    </div>
</div>
<h2><?php echo $picture->username ?></h2>

<?php endforeach;?>

