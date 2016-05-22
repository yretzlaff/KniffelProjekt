<form action="index.php" method="post" class="login">

    <!-- Fehlermeldungen -->
    <label>
        <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
    </label>
    <label>
        <input type=<? if ($fehler2 == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="92" value="Benutzer nicht vorhanden. Überprüfen Sie den Nutzernamen oder erstellen Sie einen neuen Nutzer!" readonly disabled>
    </label>
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
    <div class="clear"></div>

    
    <div>
        <table class="tabellemittig">
            <tr>
                <th>Login: </th>
                <th><input id="username" type="text" name="username" placeholder="Username"></th>
            </tr>
            <tr>
                <th>Passwort: </th>
                <th><input id="password" type="password" name="password" placeholder="Passwort"></th>
            </tr>
        </table>
    </div>



   <label>
       Account erstellen? <input type="checkbox" name="add_user" value="1">
   </label>



	<input type="submit" name="login" value="Login">
	
	<input type="submit" name="hauptmenue" value="Abbrechen">
</form>
