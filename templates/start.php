
<form action="index.php" method="post" class="start">

        <button type="submit", id="newGame", name="newGame">Neues Spiel</button>


        <button type="submit", id="continueGame", name="continueGame">Spiel fortsetzen</button>
		
		<button type="submit", id="nutzerVerwaltung", name="nutzerVerwaltung">Benutzerverwaltung</button>

        <button type="submit", id="callRanking", name="callRanking">weitere Ranglisten</button>
	
	<hr>
    <h2>	Top 10 Spieler:  </h2>
    <table class="rankingtable">

        <thead>
        <tr>
            <th class="rankingtablehead">Platz</th>
            <th class="rankingtablehead">User</th>
            <th class="rankingtablehead">Punkte</th>
        </tr>
        </thead>

        <tbody>
        <? if (!empty($ScoreListe)) for ($i = 0; $i < 10; $i++) { ?>
            <tr>
                <td><? print(($i+1) . ".") ?></td>
                <td><? print($ScoreListe[$i]['Username']) ?></td>
                <td><? print($ScoreListe[$i]['spielerscore']) ?></td>
            </tr>
        <? } ?>
        </tbody>

    </table>

</form>