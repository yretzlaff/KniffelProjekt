<form form action="index.php" method="post" class="continueGameLogin">
   
   <!-- Fehlermeldung -->
   <label>
      <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
   </label>
   <div class="clear"></div>

   
   <div>
      <table class="tabellemittig">
         <tr>
            <th>Login: </th>
            <th><?= $benutzer ?></th>
         </tr>
         <tr>
            <th>Passwort: </th>
            <th><input id="password" type="password" name="password" placeholder="Passwort"></th>
         </tr>
      </table>
   </div>

   
   <input type="submit" name="spiel_weiter" value="<? if ($naechsterSpieler == true){ echo "Spiel fortsetzen";} else {echo "Nächster Spieler";} ?>">
   <input type="submit" name="hauptmenue" value="Hauptmenü">
   

</form>