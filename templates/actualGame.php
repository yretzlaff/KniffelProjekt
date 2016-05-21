<form action="index.php" method="post" class="actualGame">
<h3 align="center">Spieler am Zug: <?= ($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getName());?></h3>


	<div class="punktetabelle">
		<table class="gametable">
	<tr> 
		<th><!-- Spalte für Bezeichnungen --></th>
		<th><!-- Spalte für Knöpfe --></th>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
		<th> <?= ($test->getName()); ?></th> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr> 
	<tr> 
		<th>Einer</th>
		<td><input type="submit" name="einer" value="<?= Punkterechner::getEinerPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>" <?= ($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetEiner())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getEiner()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
		
	</tr> 
	<tr> 
		<th>Zweier</th>
		<td><input type="submit" name="zweier" value="<?= Punkterechner::getZweierPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?= ($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetZweier())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getZweier()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Dreier</th>
		<td><input type="submit" name="dreier" value="<?= Punkterechner::getDreierPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?= ($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetDreier())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getDreier()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Vierer</th> 
		<td><input type="submit" name="vierer" value="<?= Punkterechner::getViererPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetVierer())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getVierer()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Fünfer</th> 
		<td><input type="submit" name="fuenfer" value="<?= Punkterechner::getFuenferPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?= ($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetFuenfer())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getFuenfer()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Sechser</th>
		<td><input type="submit" name="sechser" value="<?= Punkterechner::getSechserPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetSechser())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getSechser()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt</th>
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getSummeOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Bonus bei 63 o. mehr</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getBonusOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt Oben</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getGesamtOben()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Dreierpasch</th>
		<td><input type="submit" name="dreierpasch" value="<?= Punkterechner::getDreierpaschPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetDreierpasch())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getDreierpasch()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Viererpasch</th>
		<td><input type="submit" name="viererpasch" value="<?= Punkterechner::getViererpaschPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetViererpasch())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getViererpasch()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Full House</th> 
		<td><input type="submit" name="fullhouse" value="<?= Punkterechner::getFullHousePunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetFullHouse())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getFullHouse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Kleine Straße</th>
		<td><input type="submit" name="kleinestrasse" value="<?= Punkterechner::getKleineStrassePunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetKleineStrasse())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getKleineStrasse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Große Straße</th> 
		<td><input type="submit" name="grossestrasse" value="<?= Punkterechner::getGrosseStrassePunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetGrosseStrasse())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getGrosseStrasse()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Kniffel</th> 
		<td><input type="submit" name="kniffel" value="<?= Punkterechner::getKniffelPunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetKniffel())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getKniffel()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Chance</th> 
		<td><input type="submit" name="chance" value="<?= Punkterechner::getChancePunkte($Spiel->getWuerfelspiel()->getWuerfel())?>"<?=($Spiel->getSpieler()[$Spiel->getAktuellerSpieler()]->getSpielkarte()->isSetChance())?>></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getChance()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
	<tr> 
		<th>Gesamt Unten</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getGesamtUnten()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	<tr> 
		<th>Endsumme</th> 
		<td><!-- Feld bleibt leer! --></td>
		<? if (!empty($Spiel->getSpieler())) foreach ($Spiel->getSpieler() as $test) : ?>
			<td> <?= ($test->getSpielkarte()->getGesamtSumme()) ?></td> <!-- Spalte für Spieler 1 -->
		<? endforeach; ?>
	</tr>
</table>
	</div>



	<div class="bank">
		<h2> Würfel Auf der Bank: </h2>
		<button id="b1", name = "bank1"<?= $Spiel->istBankVerschiebbar(1) ?>>
			<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBank()[1] && null !== $Spiel->getWuerfelspiel()->getBank()[1]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBank()[1]->getWert()) . ".jpg";endif?>" alt="B">
		</button>
		<button id="b2", name = "bank2"<?= $Spiel->istBankVerschiebbar(2) ?>>
			<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBank()[2] && null !== $Spiel->getWuerfelspiel()->getBank()[2]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBank()[2]->getWert()) . ".jpg";endif?>" alt="B">
		</button>
		<button id="b3", name = "bank3"<?= $Spiel->istBankVerschiebbar(3) ?>>
			<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBank()[3] && null !== $Spiel->getWuerfelspiel()->getBank()[3]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBank()[3]->getWert()) . ".jpg";endif?>" alt="B">
		</button>
		<button id="b4", name = "bank4"<?= $Spiel->istBankVerschiebbar(4) ?>>
			<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBank()[4] && null !== $Spiel->getWuerfelspiel()->getBank()[4]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBank()[4]->getWert()) . ".jpg";endif?>" alt="B">
		</button>
		<button id="b5", name = "bank5"<?= $Spiel->istBankVerschiebbar(5) ?>>
			<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBank()[5] && null !== $Spiel->getWuerfelspiel()->getBank()[5]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBank()[5]->getWert()) . ".jpg";endif?>" alt="B">
		</button>

	</div>


	<div class="wurfeln">
		</br></br></br></br></br></br>
		<input type="submit" value="Würfeln" name="wuerfeln" id="wuerfeln" <?= $Spiel->istWuerfelbar() ?>></br></br>
	<button id="w1", name = "wuerfel1"<?= $Spiel->istBecherVerschiebbar(1) ?>>
		<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[1] && null !== $Spiel->getWuerfelspiel()->getBecher()[1]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBecher()[1]->getWert()) . ".jpg";endif?>" alt="W">
	</button>
	<button id="w2", name = "wuerfel2"<?= $Spiel->istBecherVerschiebbar(2) ?>>
		<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[2] && null !== $Spiel->getWuerfelspiel()->getBecher()[2]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBecher()[2]->getWert()) . ".jpg";endif?>" alt="W">
	</button>
	<button id="w3", name = "wuerfel3"<?= $Spiel->istBecherVerschiebbar(3) ?>>
		<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[3] && null !== $Spiel->getWuerfelspiel()->getBecher()[3]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBecher()[3]->getWert()) . ".jpg";endif?>" alt="W">
	</button>
	<button id="w4", name = "wuerfel4"<?= $Spiel->istBecherVerschiebbar(4) ?>>
		<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[4] && null !== $Spiel->getWuerfelspiel()->getBecher()[4]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBecher()[4]->getWert()) . ".jpg";endif?>" alt="W">
	</button>
	<button id="w5", name = "wuerfel5"<?= $Spiel->istBecherVerschiebbar(5) ?>>
		<img src="<?if(null !== $Spiel->getWuerfelspiel()->getBecher()[5] && null !== $Spiel->getWuerfelspiel()->getBecher()[5]->getWert()):print("../public/assets/images/dice_" . $Spiel->getWuerfelspiel()->getBecher()[5]->getWert()) . ".jpg";endif?>" alt="W">
	</button>


	</div>

	<div class="clear"></div>

	<div class="beenden">
		<input type="submit" name="spiel_beenden" value="Spiel beenden">
		</div>

	
	

</form>
