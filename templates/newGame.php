<form action="index.php" method="post" class="newGame">
   <label for="username">
       Login:
   </label>
   <input id="username" type="text" name="username" placeholder="test@example.com">

   <label for="password">
       Passwort:
   </label>
   <input id="password" type="password" name="password" placeholder="Passwort">
   
   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
   </label>

   <label for="new_user">
       Account erstellen?
   </label>
   <input type="checkbox" name="add_user" value="1">

   
   <input type="submit" name="weiterer_spieler" value="Weiterer Spieler" <? if ($Spiel->istSpielVollMinusEins()): print("Disabled"); endif ?>>
   

   <input type="submit" name="spiel_starten" value="Spiel Starten">
   
   <input type="submit" name="hauptmenue" value="Abbrechen">
</form>




