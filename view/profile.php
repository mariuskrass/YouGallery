<?php 
session_start();
    if($_SESSION['user_id'] == $profile->id){
        $myProfile = "hidden";
    }
    else{
        $myProfile = "show";
    }
    if($_SESSION['besucht'] == true){
        echo("Logged in");
    }
    else{
        echo("Failed to login!");
        header("Location: /login");
        die();
    }
?>

<div id="profile">
    <img id="profilbild" src="images/profile.png" width="100px">
    <div id="content">
    <h3 class="name"><?php echo $profile->username;?></h3><br><br>
    <p class="status"><?php echo $profile->status;?></p>
    </div>
<div id="floatright">
    <div id="followbutton">
                <form action="/profile/follow" method="GET" id="form">
                    <input type="hidden" name="userId" id="follow" value="<?php echo $profile->id ?>">
                    <input type="submit" class="btn btn-default <?=$myProfile?>" value="Follow" id="follow">
                </form> 
    </div>
    <div id="followcount">
        <h3 id="count_follower"><?php echo $profile->followersCount;?> Follower</h3>
    </div>
</div>
</div>
<br>
<hr id="line">
<!-- <div id="bilder">
<img src="images/profile.png" id="gallery" width="30%">
<img src="images/profile.png" id="gallery" width="30%">
<img src="images/profile.png" id="gallery" width="30%">
<img src="images/profile.png" id="gallery" width="30%">
<img src="images/profile.png" id="gallery" width="30%">
<img src="images/profile.png" id="gallery" width="30%">
</div> -->
<div id="feed">
<?php 
    $path = "var/www/uploads/";
    foreach ($profile->pictures as $picture){
        echo "<div class='feed-element'>
        <div class='feed-header'>
            <img class='feed-profilbild' src='images/profile.png'>
            <h3 class='feed-username'>$profile->username</h3>
        </div>
        <img src='" . $path . $picture->name . "' class='feed-photo'>
    </div>";
    }
?>

</div>

