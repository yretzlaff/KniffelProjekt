<form action="index.php" method="post" class="newGame">
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
	
</div> 

<div style="margin-left : 10%;">
	<input type="submit" name="spiel_fortsetzen" value="Spiel fortsetzen">
	<input type="submit" name="hauptmenue" value="zurück zum Hauptmenü"> 
</div>
</form>