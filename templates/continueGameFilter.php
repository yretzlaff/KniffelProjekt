<form action="index.php" method="post" class="continueGameFilter">
<h1 align="center">Spiel fortsetzen</h1>
<hr>

<input type="button" value="Filter anwenden" style="float: right; margin-right : 10%;"></br></br>

<div style="margin-left : 10%;">
	<input name="spielid" placeholder="SpielID">
	<input name="spieldatum" placeholder="Datum">
	<input name="anzSpieler" placeholder="Anzahl Spieler">
	<input name="spieler1" placeholder="Spieler 1">
	<input name="spieler2" placeholder="Spieler 2">
	<input name="spieler3" placeholder="Spieler 3">
	<input name="spieler4" placeholder="Spieler 4">
</div>
	
<div style="border : double 2px #0000ff; background : #ffffff; color : #000000; width : 80%; height : 60%; overflow : auto; margin-left : 10%;">
	<!-- Liste mit den begonnenen Spielen -->
	<table class="album">
		<colgroup>
			<col style="width: 20px;">
			<col style="width: 30%">
			<col style="width: 30%">
			<col style="width: 30%">
			<col>
		</colgroup>
		<thead>
		<tr>
			<th>Spiel ID</th>
			<th>Datum</th>
			<th>Anzahl Spieler</th>
			<th>Spieler 1</th>
			<th>Spieler 2</th>
			<th>Spieler 3</th>
			<th>Spieler 4</th>
		</tr>
		</thead>

		<tbody>
		<? if (!empty($filter)) foreach ($filter as $filter) : ?>
			<tr>
				<td>#<?= $filter['s_id'] ?></td>
				<td><?= h($filter['Startdatum']) ?></td>
				<td><?= h($filter['anz']) ?></td>
				<? $spieler = Spiel::getBenutzerZuSpiel($filter['s_id']) ?>
				<td><?= h($spieler[0]['username']) ?></td>
				<td><?= h($spieler[1]['username']) ?></td>
				<td><?= h($spieler[2]['username']) ?></td>
				<td><?= h($spieler[3]['username']) ?></td>
			</tr>
		<? endforeach ?>
		</tbody>

		<tfoot>
		<tr>
			<td colspan="5">All rights reserved</td>
		</tr>
		</tfoot>
	</table>
	
</div> 

<div style="margin-left : 10%;">
	<input type="submit" name="spiel_fortsetzen" value="Spiel fortsetzen">
	<input type="submit" name="hauptmenue" value="zurück zum Hauptmenü"> 
</div>
</form>