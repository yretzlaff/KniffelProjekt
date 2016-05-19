<form action="index.php" method="post" class="moreRankings">

<input type="submit" name="hauptmenue" value="zurück zum Hauptmenü"> 

<table>
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
            <td>Anzahl der Siege</td>
            <td></td>
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
	
	<table>
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
        <? if (!empty($PunkteListe)) foreach ($PunkteListe as $Punkte) { ?>
            <tr>				
                <td><? print($Punkte['ID']) ?></td>                
                <td><? print($Punkte['Username']) ?></td>
                <td><? print($Punkte['Gesamtpunktzahl']) ?></td>
            </tr>
        <? } ?>
        </tbody>
		
		

        <tfoot>
        <tr>
            <td colspan="5">All rights reserved</td>
        </tr>
        </tfoot>
    </table>