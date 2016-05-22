<form action="index.php" method="post" class="changePassword">

   <div>
       <table class="tabellemittig">
           <tr>
               <th>Akuteller Username: </th>
               <th><?= $user->getName() ?></th>
           </tr>
           <tr>
               <th>Neuer Username: </th>
               <th><input id="neuerUsername" type="text" name="neuerUsername"></th>
           </tr>
       </table>
   </div>

<<<<<<< HEAD
   <input type="submit" name="bestaetigenUsername" value="Bestätigen">
   <input type="submit" name="abbrechen" value="Abbrechen">
=======
	<input type="submit" name="bestaetigenUsername" value="Bestätigen">
	
	<input type="submit" name="abbrechen" value="Abbrechen">
	</br>
	<label>	
    <input type=<? if ($fehler3 == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="60" value="Benutzername bereits vergeben. Bitte wählen Sie einen anderen." readonly disabled>
    </label>
>>>>>>> dfd7cbc0f3fa83cb8c06267acb65988ef328fa29
</form>