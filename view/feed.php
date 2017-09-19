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
            <img class="feed-profilbild" src='/images/profile.png'>
            <a class="feed-username" href="/profile?userId=<?=$picture->id?>"><?php echo $picture->username ?></a>
        </div>
        <img src='/var/www/uploads/<?php echo $picture->name ?>' class="feed-photo">
    </div>
</div>

<?php endforeach;?>

