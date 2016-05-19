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
		<td><input type="submit" name="einer" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getEiner()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr> 
	<tr> 
		<th>Zweier</th>
		<td><input type="submit" name="zweier" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getZweier()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Dreier</th>
		<td><input type="submit" name="dreier" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getDreier()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Vierer</th> 
		<td><input type="submit" name="vierer" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getVierer()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Fünfer</th> 
		<td><input type="submit" name="fuenfer" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getFuenfer()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Sechser</th>
		<td><input type="submit" name="sechser" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getSechser()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt</th>
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getSummeOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Bonus bei 63 o. mehr</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getBonusOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt Oben</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getGesamtOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Dreierpasch</th>
		<td><input type="submit" name="dreierpasch" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getDreierpasch()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Viererpasch</th>
		<td><input type="submit" name="viererpasch" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getViererpasch()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Full House</th> 
		<td><input type="submit" name="fullhouse" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getFullHouse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Kleine Straße</th>
		<td><input type="submit" name="kleinestrasse" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getKleineStrasse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Große Straße</th> 
		<td><input type="submit" name="grossestrasse" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getGrosseStrasse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Kniffel</th> 
		<td><input type="submit" name="kniffel" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getKniffel()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Chance</th> 
		<td><input type="submit" name="chance" value=""></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getChance()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt Unten</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getGesamtUnten()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	<tr> 
		<th>Endsumme</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) :?>
			<td> <? print($test->getSpielkarte()->getGesamtSumme()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
</table> 

<input type="submit" name="spiel_beenden" value="Spiel beenden">
<input type="submit" value="Würfeln" name="wuerfeln" id="wuerfeln" >
	

	<button id="w1", name = "wuerfel1">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[1]):print($Spiel->getWuerfelspiel()->getBecher()[1]->getWert());endif?>.jpg" alt="W">
	</button>
	<button id="w2", name = "wuerfel2">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[2]):print($Spiel->getWuerfelspiel()->getBecher()[2]->getWert());endif?>.jpg" alt="W">
	</button>
	<button id="w3", name = "wuerfel3">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[3]):print($Spiel->getWuerfelspiel()->getBecher()[3]->getWert());endif?>.jpg" alt="W">
	</button>
	<button id="w4", name = "wuerfel4">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[4]):print($Spiel->getWuerfelspiel()->getBecher()[4]->getWert());endif?>.jpg" alt="W">
	</button>
	<button id="w5", name = "wuerfel5">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[5]):print($Spiel->getWuerfelspiel()->getBecher()[5]->getWert());endif?>.jpg" alt="W">
	</button>


	<button id="b1", name = "bank1">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBank()[1]):print($Spiel->getWuerfelspiel()->getBank()[1]->getWert());endif?>.jpg" alt="B">
	</button>
	<button id="b2", name = "bank2">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBank()[2]):print($Spiel->getWuerfelspiel()->getBank()[2]->getWert());endif?>.jpg" alt="B">
	</button>
	<button id="b3", name = "bank3">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBank()[3]):print($Spiel->getWuerfelspiel()->getBank()[3]->getWert());endif?>.jpg" alt="B">
	</button>
	<button id="b4", name = "bank4">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBank()[4]):print($Spiel->getWuerfelspiel()->getBank()[4]->getWert());endif?>.jpg" alt="B">
	</button>
	<button id="b5", name = "bank5">
		<img src="../public/assets/images/dice_<?if(null !== $Spiel->getWuerfelspiel()->getBank()[5]):print($Spiel->getWuerfelspiel()->getBank()[5]->getWert());endif?>.jpg" alt="B">
	</button>



	<?print_r($Spiel->getWuerfelspiel()->getBecher()[5])?>
	

</form>
