<form action="index.php" method="post" class="moreRankings">

<input type="submit" name="hauptmenue" value="zurück zum Hauptmenü"> 

	<hr>
	<h2>Meisten Siege:</h2>
	<table class="rankingtable">
		<thead>
		<tr>
			<th class="rankingtablehead">Platz</th>
			<th class="rankingtablehead">User</th>
			<th class="rankingtablehead">Anzahl der Siege</th>
		</tr>
		</thead>

		<tbody>
		<? if (!empty($WinListe)) for ($i = 0; i < 10; $i++) { ?>
			<tr>				
				<td><? print($i + 1 . ".") ?></td>                
				<td><? print($WinListe[$i]['Username']) ?></td>
				<td><? print($WinListe[$i]['Anzahl']) ?></td>
			</tr>
		<? } ?>
		</tbody>
			
			
	</table>
		
	<hr>
	<h2>Meisten Punkte in einem Spiel:</h2>
	<table class="rankingtable">
		<thead>
		<tr>
			<th class="rankingtablehead">Platz</th>
			<th class="rankingtablehead">User</th>
			<th class="rankingtablehead">Punkte</th>
		</tr>
		</thead>

		<tbody>
		<? if (!empty($PunkteListe)) for ($i = 0; $i < 10; $i++) { ?>
			<tr>				
				<td><? print($i + 1 . ".") ?></td>
				<td><? print($PunkteListe[$i]['Username']) ?></td>
				<td><? print($PunkteListe[$i]['Gesamtpunktzahl']) ?></td>
			</tr>
		<? } ?>
		</tbody>
			

	</table>
