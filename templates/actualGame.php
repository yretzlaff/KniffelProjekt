<form action="index.php" method="post" class="newGame">
<h3 align="right">Spieler am Zug: <? print($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getName());?></h3>

<table> 
	<tr> 
		<th><!-- Spalte für Bezeichnungen --></th>
		<th><!-- Spalte für Knöpfe --></th>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
		<th> <? print($test->getName()) ?></th> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr> 
	<tr> 
		<th>Einer</th>
		<td><input type="button" name="einer" value=""></td>
	</tr> 
	<tr> 
		<th>Zweier</th>
		<td><input type="button" name="zweier" value=""></td>			
	</tr>
	<tr> 
		<th>Dreier</th>
		<td><input type="button" name="dreier" value=""></td>			
	</tr>
	<tr> 
		<th>Vierer</th> 
		<td><input type="button" name="vierer" value=""></td>
	</tr>
	<tr> 
		<th>Fünfer</th> 
		<td><input type="button" name="fuenfer" value=""></td>
	</tr>
	<tr> 
		<th>Sechser</th>
		<td><input type="button" name="sechser" value=""></td>				
	</tr>
	<tr> 
		<th>Gesamt</th>
		<td><input type="button" name="gesamt" value=""></td>			
	</tr>
	<tr> 
		<th>Bonus bei 63 o. mehr</th> 
		<td><!-- Feld bleibt leer! --></td>	
	</tr>
	<tr> 
		<th>Gesamt Oben</th> 
		<td><!-- Feld bleibt leer! --></td>
	</tr>
	<tr> 
		<th>Dreierpasch</th>
		<td><input type="button" name="dreierpasch" value=""></td>	
	</tr>
	<tr> 
		<th>Viererpasch</th>
		<td><input type="button" name="viererpasch" value=""></td>	
	</tr>
	<tr> 
		<th>Full-House</th> 
		<td><input type="button" name="fullhouse" value=""></td>	
	</tr>
	<tr> 
		<th>Kleine Straße</th>
		<td><input type="button" name="kleinestrasse" value=""></td>	
	</tr>
	<tr> 
		<th>Große Straße</th> 
		<td><input type="button" name="grossestrasse" value=""></td>	
	</tr>
	<tr> 
		<th>Kniffel</th> 
		<td><input type="button" name="kniffel" value=""></td>	
	</tr>
	<tr> 
		<th>Chance</th> 
		<td><input type="button" name="chance" value=""></td>	
	</tr>
	<tr> 
		<th>Gesamt Unten</th> 
		<td><!-- Feld bleibt leer! --></td>
	<tr> 
		<th>Endsumme</th> 
		<td><!-- Feld bleibt leer! --></td>
	</tr>
</table> 

<input type="submit" name="spiel_beenden" value="Spiel beenden">
<input type="button" value="Würfeln" name="wuerfeln" id="wuerfeln" onclick=<?$Spiel->getWuerfelspiel()->wuerfeln(); ?>>
<input type="button" name="bank1" value="">
<input type="button" name="bank2" value="">
<input type="button" name="bank3" value="">
<input type="button" name="bank4" value="">
<input type="button" name="bank5" value="">
	
	
	<button id="bt1", name = "wuerfel1">
		<img src="../public/assets/images/dice_<?print($Spiel->getWuerfelspiel()->getBecher()[1]->getWert())?>.jpg" alt="X">
	</button>
	<button id="bt2", name = "wuerfel2">
		<img src="../public/assets/images/dice_<?print($Spiel->getWuerfelspiel()->getBecher()[2]->getWert())?>.jpg" alt="X">
	</button>
	<button id="bt3", name = "wuerfel3">
		<img src="../public/assets/images/dice_<?print($Spiel->getWuerfelspiel()->getBecher()[3]->getWert())?>.jpg" alt="X">
	</button>
	<button id="bt4", name = "wuerfel4">
		<img src="../public/assets/images/dice_<?print($Spiel->getWuerfelspiel()->getBecher()[4]->getWert())?>.jpg" alt="X">
	</button>
	<button id="bt5", name = "wuerfel5">
		<img src="../public/assets/images/dice_<?print($Spiel->getWuerfelspiel()->getBecher()[5]->getWert())?>.jpg" alt="X">
	</button>
	
<input type="button" name="wuerfel2" value="">
<input type="button" name="wuerfel3" value="">
<input type="button" name="wuerfel4" value="">
<input type="button" name="wuerfel5" value="">

	<?print_r($Spiel->getWuerfelspiel()->getBecher()[5])?>
	

</form>
