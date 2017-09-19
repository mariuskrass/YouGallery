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
        <div class="feed-header feed-username">
            <img class="feed-profilbild" src='/images/profile.png'>
            <a class="feed-usernam" href="/profile?userId=<?=$picture->id?>"><?php echo $picture->username ?></a>
        </div>
        <div id="functionside">
            <ul>
                <li><a class="iconsside-heart" href=""><span class="glyphicon glyphicon-heart-empty"></a></span></li>
                <li><a class="iconsside" href=""><span class="glyphicon glyphicon-comment"></a></span></li>
            </ul>
        </div>
        <img src='/var/www/uploads/<?php echo $picture->name ?>' class="feed-photo">
    </div>
</div>

<?php endforeach;?>

