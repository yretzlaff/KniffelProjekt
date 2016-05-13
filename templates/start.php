
<form action="index.php" method="post" class="start">

        <button type="submit", id="newGame", name="newGame">Neues Spiel</button>


        <button type="submit", id="continueGame", name="continueGame">Spiel fortsetzen</button>
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
            <td>#ID</td>
            <td>User</td>
            <td>Punkte</td>
            <td></td>
        </tr>
        </thead>

        <tbody>
        <? if (!empty($ranking)) foreach ($ranking as $ranking) : ?>
            <tr>
                <td>#<?= $ranking['ID'] ?></td>
                <td><?= h($ranking['Kuenstler']) ?></td>
                <td><?= h($ranking['Album']) ?></td>
                <td><?= h($ranking['Erscheinungsjahr']) ?></td>
                <td><?=  date("d.m.Y", strtotime($album['Zeitstempel'])) ?></td>
            </tr>
        <? endforeach ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="5">All rights reserved</td>
        </tr>
        </tfoot>
    </table>

</form>