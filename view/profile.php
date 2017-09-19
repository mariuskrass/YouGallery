<form action="/profile/follow" method="GET">
<input type="hidden" name="userId" value="<?php echo $profile->id ?>" />
<input type="submit" value="Follow">
</form>

<h3><?php echo $profile->username;?></h3>
<h3><?php echo $profile->status;?></h3>
<h3><?php echo $profile->followersCount;?></h3>

<?php 
    $path = "var/www/uploads/";
    foreach ($profile->pictures as $picture){
        echo "<img src='" . $path . $picture->name . "' ><br>";
    }
?>