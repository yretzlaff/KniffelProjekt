<form form action="index.php" method="post" class="continueGameLogin">
	   <label for="username">
       Login:
   </label>
   <label id="username" name="username" > <?= $benutzer['username'] ?></label>

   <label for="password">
       Passwort:
   </label>
   <input id="password" type="password" name="password" placeholder="Passwort">

   
   <input type="submit" name="naechster_spieler" value="naechster_spieler">
   

</form>