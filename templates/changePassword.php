<form action="index.php" method="post" class="changePassword">
   
   <label>
      <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="30" value="Passwörter stimmen nicht überein!" readonly disabled>
   </label><div class="clear"></div>

   <div>
      <table class="tabellemittig">
         <tr>
            <th>Neues Passwort: </th>
            <th><input id="neuesPasswort" type="password" name="neuesPasswort"></th>
         </tr>
         <tr>
            <th>Neues Passwort wiederholen:</th>
            <th><input id="wiederholungPasswort" type="password" name="wiederholungPasswort"></th>
         </tr>
      </table>
   </div>

	<input type="submit" name="bestaetigenPasswort" value="Bestätigen">
	<input type="submit" name="abbrechen" value="Abbrechen">


</form>