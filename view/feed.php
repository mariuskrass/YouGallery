<?php
session_start();
if($_SESSION['besucht'] == true){
    echo("Logged in");
}
else{
    echo("Failed to login!");
}

foreach($pictures as $picture) :?>
<h2><?php echo $picture->username ?></h2>
<img src='/var/www/uploads/<?php echo $picture->name ?>' width='100' height='100'>
<?php endforeach;?>