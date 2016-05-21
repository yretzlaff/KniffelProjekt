<form action="index.php" method="post" class="moreRankings">

<input type="submit" name="hauptmenue" value="zurück zum Hauptmenü"> 

	<hr>
	<h2>Meisten Siege:</h2>
	<table class="rankingtable">
		<thead>
		<tr>
			<th class="rankingtablehead">ID</th>
			<th class="rankingtablehead">User</th>
			<th class="rankingtablehead">Anzahl der Siege</th>
		</tr>
		</thead>

		<tbody>
		<? if (!empty($WinListe)) foreach ($WinListe as $Wins) { ?>
			<tr>				
				<td><? print($Wins['ID']) ?></td>                
				<td><? print($Wins['Username']) ?></td>
				<td><? print($Wins['Anzahl']) ?></td>
			</tr>
		<? } ?>
		</tbody>
			
			
	</table>
		
	<hr>
	<h2>Meisten Punkte in einem Spiel:</h2>
	<table class="rankingtable">
		<thead>
		<tr>
			<th class="rankingtablehead">ID</th>
			<th class="rankingtablehead">User</th>
			<th class="rankingtablehead">Punkte</th>
		</tr>
		</thead>

		<tbody>
		<? if (!empty($PunkteListe)) foreach ($PunkteListe as $Punkte) { ?>
			<tr>				
				<td><? print($Punkte['ID']) ?></td>                
				<td><? print($Punkte['Username']) ?></td>
				<td><? print($Punkte['Gesamtpunktzahl']) ?></td>
			</tr>
		<? } ?>
		</tbody>
			

	</table>
