
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
            <th class="rankingtablehead">ID</th>
            <th class="rankingtablehead">User</th>
            <th class="rankingtablehead">Punkte</th>
        </tr>
        </thead>

        <tbody>
        <? if (!empty($ScoreListe)) foreach ($ScoreListe as $Score) { ?>
            <tr>
                <td><? print($Score['ID']) ?></td>
                <td><? print($Score['Username']) ?></td>
                <td><? print($Score['spielerscore']) ?></td>
            </tr>
        <? } ?>
        </tbody>

    </table>

</form>