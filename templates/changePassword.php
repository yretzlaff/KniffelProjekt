<form action="index.php" method="post" class="changePassword">
   <label for="neuesPasswort">
       Neues Passwort:
   </label>
   <input id="neuesPasswort" type="password" name="neuesPasswort">

   <label for="wiederholungPasswort">
       Neues Passwort wiederholen:
   </label>
   <input id="wiederholungPasswort" type="password" name="wiederholungPasswort">
   
   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="30" value="Passwörter stimmen nicht überein!" readonly disabled>
   </label>

	<input type="submit" name="bestaetigenPasswort" value="Bestätigen">
	<input type="submit" name="abbrechen" value="Abbrechen">
</form>