<form form action="index.php" method="post" class="continueGameLogin">
	   <label for="username">
       Login:
   </label>
   <label id="username" name="username" > <?= $benutzer[0]['username'] ?></label>

   <label for="password">
       Passwort:
   </label>
   <input id="password" type="password" name="password" placeholder="Passwort">

   
   <input type="submit" name="naechster_spieler" value="Nächster Spieler">
   <input type="submit" name="spiel_fortsetzen2" value="Spiel fortsetzen">
   <input type="submit" name="hauptmenue2" value="Hauptmenü">
   

</form>