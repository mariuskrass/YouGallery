<?php 

    if(!isset($_SESSION['user_id'])){
        echo("Fail");
        header('Location: /login');
        exit();  
    }
    else {
        echo ($_SESSION['user_id']);
        
    }
    
?>