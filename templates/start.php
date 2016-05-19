
<form action="index.php" method="post" class="start">

        <button type="submit", id="newGame", name="newGame">Neues Spiel</button>


        <button type="submit", id="continueGame", name="continueGame">Spiel fortsetzen</button>
		
		<button type="submit", id="nutzerVerwaltung", name="nutzerVerwaltung">Benutzerverwaltung</button>

        <button type="submit", id="callRanking", name="callRanking">weitere Ranglisten</button>
    <br>
   <label for="Ranking">
Ranking
   </label>
    <table class="ranking">
        <colgroup>
            <col style="width: 20px;">
            <col style="width: 30%">
            <col style="width: 30%">
            <col style="width: 30%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <td>ID</td>
            <td>User</td>
            <td>Punkte</td>
            <td></td>
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

        <tfoot>
        <tr>
            <td colspan="5">All rights reserved</td>
        </tr>
        </tfoot>
    </table>

</form>