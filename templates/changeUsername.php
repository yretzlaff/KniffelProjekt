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
    
	<input type="submit" name="bestaetigenUsername" value="Bestätigen">
	
	<input type="submit" name="abbrechen" value="Abbrechen">
	</br>
	<label>	
    <input type=<? if ($fehler3 == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="60" value="Benutzername bereits vergeben. Bitte wählen Sie einen anderen." readonly disabled>
    </label>
    <label>
        <input type=<? if ($fehler5 == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="61"
               value="Benutzername darf nicht leer sein. Bitte wählen Sie einen anderen." readonly
               disabled>
    </label>
	
    <label>
        <input type=<? if ($fehler6 == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="78"
               value="Benutzername darf nicht länger als 15 Zeichen sein. Bitte wählen Sie einen anderen." readonly
               disabled>
    </label>		
</form>