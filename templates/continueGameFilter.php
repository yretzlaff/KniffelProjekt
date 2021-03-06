<form action="index.php" method="post" class="continueGameFilter">
    <h1 align="center">Spiel fortsetzen</h1>
    <hr>
    
   <label>	
   <input type=<? if ($fehler == false){ echo "hidden";} else {echo "text";}?> name="fehler" size="131" value="Sie haben kein Spiel ausgewählt. Sie müssen ein Spiel über die Radio Buttons vor den Spielen auswählen um ein Spiel fortsetzen zu können." readonly disabled>
   </label>
   
    <input type="submit" name="filter_entfernen" value="Filter entfernen" class="filterbuttons">
    <input type="submit" name="filter_anwenden"  value="Filter anwenden"  class="filterbuttons">


    <div class="clear"></div>
    <div class="filter">
        <!-- Liste mit den begonnenen Spielen -->
        <table class="filtertable">
            <thead>
            <tr>
                <th></th>
                <th>Spiel ID</th>
                <th>Datum</th>
                <th>Anzahl Spieler</th>
                <th>Spieler 1</th>
                <th>Spieler 2</th>
                <th>Spieler 3</th>
                <th>Spieler 4</th>
            </tr>
            <tr>
                <th></th>
                <th><input type="search" name="spielid" placeholder="Spiel ID" value="<?= $filter['id'] ?>"></th>
                <th><input type="date" name="spieldatum" placeholder="Datum" value="<?= $filter['dat'] ?>"></th>
                <th><input type="search" name="anzSpieler" placeholder="Anzahl Spieler" value="<?= $filter['anz'] ?>"></th>
                <th><input type="search" name="spieler1" placeholder="Spieler 1" value="<?= $filter['s1'] ?>"></th>
                <th><input type="search" name="spieler2" placeholder="Spieler 2" value="<?= $filter['s2'] ?>"></th>
                <th><input type="search" name="spieler3" placeholder="Spieler 3" value="<?= $filter['s3'] ?>"></th>
                <th><input type="search" name="spieler4" placeholder="Spieler 4" value="<?= $filter['s4'] ?>"></th>
            </tr>

            </thead>

            <tbody>
            <? if (!empty($spiele)) foreach ($spiele as $s) : ?>
                <tr>
                    <td><input type="radio" name="werte" value="<?= $s['s_id'] ?>"></td>
                    <td><?= $s['s_id'] ?></td>
                    <td><?= h($s['Startdatum']) ?></td>
                    <td><?= h($s['anz']) ?></td>
                    <td><?= h($s['s1']) ?></td>
                    <td><?= h($s['s2']) ?></td>
                    <td><?= h($s['s3']) ?></td>
                    <td><?= h($s['s4']) ?></td>
                </tr>
            <? endforeach ?>
            </tbody>
        </table>

    </div>

    <div class="clear"></div>
    <div>
        <input type="submit" name="spiel_fortsetzen" value="Spiel fortsetzen">
        <input type="submit" name="hauptmenue" value="zurück zum Hauptmenü">
    </div>
</form>