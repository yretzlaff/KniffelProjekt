<form action="index.php" method="post" class="changePassword">

   <label for="username">
       Akuteller Username:
   </label>
   <label id="username" name="username" > <?= $user->getName() ?></label>
   
   
   <label for="neuerUsername">
       Neuer Username:
   </label>
   <input id="neuerUsername" type="text" name="neuerUsername">

	<input type="submit" name="bestaetigenUsername" value="Bestätigen">
	
	<input type="submit" name="abbrechen" value="Abbrechen">
</form>