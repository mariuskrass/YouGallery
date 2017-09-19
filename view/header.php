<?php 
session_start();
if($_SESSION['besucht'] == true){
      $option_text = " Logout";
      $link = "/Logout";
      $class = "glyphicon glyphicon-log-out";
}
else{
  $option_text = " Login";
  $link = "/Login";
  $class = "glyphicon glyphicon-log-in";
}

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | YouGallery</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">YouGallery</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav ">
        <li class="active"><a href="/feed">Feed</a></li>
        <li><a href="#">Hot</a></li>
        <li><a href="/picture">Bild hochladen</a></li>
      </ul>
      
      <div class="col-sm-3 col-md-3">
        <form class="navbar-form " role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" id="search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
        </div>
    	<ul class="nav navbar-nav navbar-right">
        <li><a href="/user"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href=<?= $link ?>><span class="<?= $class ?>"></span><?= $option_text ?></a></li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container">

    <h1><?= $heading ?></h1>
