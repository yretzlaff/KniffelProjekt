<form form action="index.php" method="post" class="continueGameLogin">
	   <label for="username">
       Login:
   </label>
   <label id="username" name="username" > <?= $benutzer ?></label>

   <label for="password">
       Passwort:
   </label>
   <input id="password" type="password" name="password" placeholder="Passwort">

   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
   </label>
   
   <input type="submit" name="spiel_weiter" value="Spiel fortsetzen">
   <input type="submit" name="hauptmenue" value="Hauptmenü">
   

</form>