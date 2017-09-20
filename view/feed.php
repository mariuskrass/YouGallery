<?php 
session_start();
if($_SESSION['besucht'] == true){
}
else{
    echo("Failed to login!");
    header("Location: /login");
    die();
}


foreach($pictures as $picture) :?>

<?php
$picture->isLiked ? $heartClass = "glyphicon glyphicon-heart" : $heartClass = "glyphicon glyphicon-heart-empty";
?>

<div id="feed">
    <div class="feed-element">
        <div class="feed-header feed-username">
            <img class="feed-profilbild" src='/images/profile.png'>
            <a class="feed-usernam" href="/profile?userId=<?=$picture->id?>"><?php echo $picture->username ?></a>
        </div>
        <div id="functionside">
            <ul>
                <li><a class="iconsside-heart" href="/feed/like?pictureId=<?=$picture->id?>"><span class="<?=$heartClass?>"></a></span></li>
                <li><a class="iconsside" href=""><span class="glyphicon glyphicon-comment"></a></span></li>
            </ul>
        </div>
        <img src='/var/www/uploads/<?php echo $picture->name ?>' class="feed-photo">
    </div>
</div>

<?php endforeach;?>

