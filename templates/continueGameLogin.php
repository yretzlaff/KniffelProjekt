<form form action="index.php" method="post" class="continueGameLogin">
	   <label for="username">
       Login:
   </label>
   <label id="username" name="username" > <?= $benutzer ?></label>

   <label for="password">
       Passwort:
   </label>
   <input id="password" type="password" name="password" placeholder="Passwort">

    
   <input type="submit" name="spiel_weiter" value="Spiel fortsetzen">
   <input type="submit" name="hauptmenue" value="Hauptmenü">
   

</form>