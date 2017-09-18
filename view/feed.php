<?php 
session_start();
    if($_SESSION['besucht'] == true){
        echo("Logged in");
    }
    else{
        echo("Failed to login!");
    }
    
?>