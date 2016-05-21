<form action="index.php" method="post" class="login">
   <label for="username">
		Login:
		<input id="username" type="text" name="username" placeholder="Username">
   </label>


   <label for="password">
       Passwort:
	   <input id="password" type="password" name="password" placeholder="Passwort">
   </label>

   <label for="new_user">
       Account erstellen?
   </label>
   <input type="checkbox" name="add_user" value="1">

   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
   </label>
   
   <label>	
   <input type=<? if ($fehler2 == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="92" value="Benutzer nicht vorhanden. Überprüfen Sie den Nutzernamen oder erstellen Sie einen neuen Nutzer!" readonly disabled>
   </label>
   
   <label>	
   <input type=<? if ($fehler3 == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="60" value="Benutzername bereits vergeben. Bitte wählen Sie einen anderen." readonly disabled>
   </label>

	<input type="submit" name="login" value="Login">
	
	<input type="submit" name="hauptmenue" value="Abbrechen">
</form>
