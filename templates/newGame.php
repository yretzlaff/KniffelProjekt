<form action="index.php" method="post" class="newGame">

    <!--Ausgaben für Fehlermeldungen-->
    <label>
        <input type=<? if ($fehler == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="47" value="Benutzername und Passwort stimmen nicht überein!" readonly disabled>
    </label>
    <label>
        <input type=<? if ($fehler2 == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="92"
               value="Benutzer nicht vorhanden. Überprüfen Sie den Nutzernamen oder erstellen Sie einen neuen Nutzer!"
               readonly disabled>
    </label>
    <label>
        <input type=<? if ($fehler3 == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="60" value="Benutzername bereits vergeben. Bitte wählen Sie einen anderen."
               readonly disabled>
    </label>
    <label>
        <input type=<? if ($fehler4 == false) {
            echo "hidden";
        } else {
            echo "text";
        } ?> name="fehler" size="68"
               value="Benutzer ist breits zum Spiel angemeldet. Bitte wählen Sie einen anderen." readonly
               disabled>
    </label>
    <div class="clear"></div>


    <div>
        <table class="tabellemittig">
            <tr>
                <th>Login: </th>
                <th><input id="username" type="text" name="username" placeholder="Benutzernamen"></th>
            </tr>
            <tr>
                <th>Passwort: </th>
                <th><input id="password" type="password" name="password" placeholder="Passwort"></th>
            </tr>
        </table>
    </div>

    <label for="new_user">
        Account erstellen? <input type="checkbox" name="add_user" value="1">
    </label>
    <div class="clear"></div>


    <input type="submit" name="weiterer_spieler"
           value="Weiterer Spieler" <? if ($Spiel->istSpielVollMinusEins()): print("Disabled"); endif ?>>

    <input type="submit" name="spiel_starten" value="Spiel Starten">

    <input type="submit" name="hauptmenue" value="Abbrechen">





    <div class="clear"></div><br>

    <? if (!empty($Spieler)) : ?>

        <table class="usertable">
            <thead>
            <tr>
                <th class="usertablehead">Bereits angemeldete Nutzer:</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($Spieler as $s) : ?>
               <tr>
                    <td><?= $s->getName() ?></td>
               </tr>
            <? endforeach; ?>
            </tbody>
        </table>


    <? endif; ?>
</form>




