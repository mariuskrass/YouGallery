<?php 
	if($error){
		echo('<div class="alert alert-danger"><strong>Error!</strong> Benutzername oder Passwort falsch!
		</div>');
	}
?>
<form action="/login/doLogin" method="POST">
	<span>Benutzername</span><br>
	<input name="benutzername" type="text" placeholder="Benutzername" class="form-control input-md"><br>
	<span>Password</span><br>
	<input name="passwort" type="password" placeholder="Passwort" class="form-control input-md"><br>
	<button type="submit" class="btn btn-default">Login</button>
</form>
