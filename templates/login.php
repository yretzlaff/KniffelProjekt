<form action="index.php" method="post" class="login">
   <label for="username">
		Login:
		<input id="username" type="text" name="username" placeholder="Username">
   </label>


   <label for="password">
       Passwort:
	   <input id="password" type="password" name="password" placeholder="Passwort">
   </label>

   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
   </label>

	<input type="submit" name="login" value="Login">
	
	<input type="submit" name="hauptmenue" value="Abbrechen">
</form>
