<?php

/**
 * Die index Klasse fungiert als Controller und dient der Abwicklung des Kontrollflusses.
 * Es werden die entsprechenden Seiten aufgerufen.
 */


require_once '../config.php';


// Initialisierung der Variablen
$template_data = array();


//  Verzweigung zum Hauptmenü
if (isset($_POST[hauptmenue])) {
    SESSION::logout();
    $spiel = new Spiel();
    $_SESSION['Spiel'] = $spiel;
    $template_data['Spiel'] = $_SESSION['Spiel'];
    $_SESSION['anzahlSpieler'] = 0;
    $template_data['ScoreListe'] = Ranking::getScoreListe();
    Template::render('start', $template_data);
}


//Verzweigung auf der Startseite mit den Buttons Neues Spiel, Spiel fortsetzen und Benutzerverwaltung und Ranking
//start -> "Neues Spiel" Button
if (isset($_POST[newGame])) {
    SESSION::starten();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('newGame', $template_data);
} else
    //start -> "Spiel fortsetzen" Button
    if (isset($_POST[continueGame])) {
        SESSION::starten();

        $alleSpiele = Spiel::getSpielListe();

        //Die Namen der Spieler zu allen Zeilen hinzufügen
        for ($i = 0; $i < count($alleSpiele); $i++) {
            $spieler = Spiel::getBenutzerZuSpiel($alleSpiele[$i]['s_id']);
            $alleSpiele[$i]['s1'] = $spieler[0]['username'];
            $alleSpiele[$i]['s2'] = $spieler[1]['username'];
            $alleSpiele[$i]['s3'] = $spieler[2]['username'];
            $alleSpiele[$i]['s4'] = $spieler[3]['username'];
        }

        $template_data['filter'] = array();
        $template_data['spiele'] = $alleSpiele;
        Template::render('continueGameFilter', $template_data);

    } else
        //start -> "Ranking aufrufen" Button
        if (isset($_POST[callRanking])) {
            SESSION::starten();
            $template_data['WinListe'] = Ranking::getMeistenSiege();
            $template_data['PunkteListe'] = Ranking::getPunkteListe();
            Template::render('moreRankings', $template_data);
        }

//start -> "Benutzerverwaltung" Button
if (isset($_POST[nutzerVerwaltung])) {
    SESSION::starten();
    Template::render('login', $template_data);
}

//Verzweigung auf der Login Seite mit den Buttons Login und Abbrechen
if (isset($_POST[login])) {
	if (isset($_REQUEST['add_user'])) 
	{
		//verschiedene Abfragen um auf eine gültige Eingabe zu prüfen
		if (!SESSION::nutzerNichtVorhanden($_REQUEST['username']))
		{
			//Benutzername bereist vergeben.
			$template_data['fehler3'] = true;
			Template::render('login', $template_data);			
		}
		else
		{
			if (empty($_REQUEST['username']))
			{
				//Benutzername darf nicht leer sein
				$template_data['fehler5'] = true;
				$template_data['user'] = $_SESSION['user'];
				Template::render('login', $template_data);						
			}
			else
			{
				if (strlen($_REQUEST['username']) > 15)
				{
					//Benutzername darf nicht länger als 15 Zeichen sein.
					$template_data['fehler6'] = true;
					$template_data['user'] = $_SESSION['user'];
					Template::render('login', $template_data);					
				}
				else
				{			
					Session::create_user($_REQUEST['username'], $_REQUEST['password']);
					$_SESSION['user'] = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
					$template_data['user'] = $_SESSION['user'];
					Template::render('userEdit', $template_data);
				}
			}
		}
	} else
	{
		//Neuer Nutzer erzeugen Haken ist nicht gesetzt. Es werden die Nutzer-Daten abgefragt.
		if (Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
			$_SESSION['user'] = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
			$template_data['user'] = $_SESSION['user'];
			Template::render('userEdit', $template_data);
		} else {
			if (SESSION::nutzerNichtVorhanden($_REQUEST['username']))
			{
				//Benutzer nicht vorhanden.
				$template_data['fehler2'] = true;
				Template::render('login', $template_data);
			}
			else
			{
				//Benutzername und Passwort stimmen nicht überein, anzeige Selbe Maske mit Fehler
				$template_data['fehler'] = true;
				Template::render('login', $template_data);
			}
		}
	}
}

//Verzweigung auf der Nutzerverwaltungsseite mit den Buttons Nutzername ändern, Passwort ändern, Account löschen und

if (isset($_POST[namenAendern])) {
    $template_data['user'] = $_SESSION['user'];
    Template::render('changeUsername', $template_data);
} else

    if (isset($_POST[passwortAendern])) {
        Template::render('changePassword', $template_data);
    }


//Verzweigung auf der Username ändern Seite mit den Buttons Bestätigen und Abbrechen
if (isset($_POST[bestaetigenUsername])) {
	if (!SESSION::nutzerNichtVorhanden($_REQUEST['neuerUsername']))
	{
		//Benutzername bereist vergeben.
		$template_data['fehler3'] = true;
		$template_data['user'] = $_SESSION['user'];
		Template::render('changeUsername', $template_data);			
	}
	else
	{
		if (empty($_REQUEST['neuerUsername']))
		{
			//Benutzername darf nicht leer sein
			$template_data['fehler5'] = true;
			$template_data['user'] = $_SESSION['user'];
			Template::render('changeUsername', $template_data);							
		}
		else
		{
			if (strlen($_REQUEST['neuerUsername']) > 15)
			{
				//Benutzername darf nicht länger als 15 Zeichen sein.
				$template_data['fehler6'] = true;
				$template_data['user'] = $_SESSION['user'];
				Template::render('changeUsername', $template_data);							
			}
			else
			{			
				Benutzer::changeUsername(Benutzer::getIdZuNamen($_SESSION['user']->getName()), $_REQUEST['neuerUsername']);
				$_SESSION['user']->setName($_REQUEST['neuerUsername']);
				Template::render('userEdit', $template_data);
			}
		}	
	}
}

//Verzweigung auf der Passwort ändern Seite mit den Buttons Bestätigen und Abbrechen
if (isset($_POST[bestaetigenPasswort])) {
    if ($_REQUEST['neuesPasswort'] == $_REQUEST['wiederholungPasswort']) {
        $hash = password_hash($_REQUEST['neuesPasswort'], PASSWORD_DEFAULT);
        Benutzer::changePassword(Benutzer::getIdZuNamen($_SESSION['user']->getName()), $hash);
        Template::render('userEdit', $template_data);
    } else {
		//Passwörter stimmen nicht überein, anzeige Selbe Maske mit Fehler
		$template_data['fehler'] = true;
		Template::render('changePassword', $template_data);
    }
}

if (isset($_POST[abbrechen])) {
    Template::render('userEdit', $template_data);
}

//Verzweigung auf der Neues Spiel Seite mit den Buttons Weiterer Spieler, Spiel starten und Abbrechen
//neues Spiel -> "Weiterer Spieler" Button
if (isset($_POST[weiterer_spieler])) {
    if (!$_SESSION['Spiel']->istSpielVoll()) {
        if (isset($_REQUEST['add_user'])) {
			if (empty($_REQUEST['username']))
			{
				//Benutzername darf nicht leer sein
				$template_data['fehler5'] = true;
				$template_data['Spiel'] = $_SESSION['Spiel'];
				Template::render('newGame', $template_data);						
			}
			else
			{
				if (strlen($_REQUEST['username']) > 15)
				{
					//Benutzername darf nicht länger als 15 Zeichen sein.
					$template_data['fehler6'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];
					Template::render('newGame', $template_data);						
				}
				else
				{			
					if (!SESSION::nutzerNichtVorhanden($_REQUEST['username']))
					{
						//Benutzername bereist vergeben.
						$template_data['fehler3'] = true;
						$template_data['Spiel'] = $_SESSION['Spiel'];
						Template::render('newGame', $template_data);			
					}
					else
					{				
					Session::create_user($_REQUEST['username'], $_REQUEST['password']);
					$_SESSION['anzahlSpieler']++;
					$spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
					$_SESSION['Spiel']->hinzufuegenSpieler($spieler);
					$template_data['Spiel'] = $_SESSION['Spiel'];
					$template_data['Spieler'] = $_SESSION['Spiel']->getSpieler();
					Template::render('newGame', $template_data);
					}
				}
			}
        } else {
            if (Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
                $spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
				if ($_SESSION['Spiel']->istSpielerSchonAngemeldet($spieler))
				{
					//Spieler ist bereist Angemeldet
					$template_data['fehler4'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];					
					Template::render('newGame', $template_data);					
				} else
				{
				$_SESSION['anzahlSpieler']++;
                $_SESSION['Spiel']->hinzufuegenSpieler($spieler);
                $template_data['Spiel'] = $_SESSION['Spiel'];
				$template_data['Spieler'] = $_SESSION['Spiel']->getSpieler();				
                Template::render('newGame', $template_data);
				}
            } else {
				if (SESSION::nutzerNichtVorhanden($_REQUEST['username']))
				{
					//Benutzer nicht vorhanden.
					$template_data['fehler2'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];					
					Template::render('newGame', $template_data);
				}
				else
				{
					//Benutzername und Passwort stimmen nicht überein, anzeige Selbe Maske mit Fehler
					$template_data['fehler'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];
					Template::render('newGame', $template_data);
				}
            }
        }
    }
} else

    // neues Spiel -> "Spiel starten" Button
    if (isset($_POST[spiel_starten])) {
        if (isset($_REQUEST['add_user'])) {
			if (!SESSION::nutzerNichtVorhanden($_REQUEST['username']))
			{
				//Benutzername bereist vergeben.
				$template_data['fehler3'] = true;
				$template_data['Spiel'] = $_SESSION['Spiel'];
				Template::render('newGame', $template_data);			
			}
			else
			{
				if (empty($_REQUEST['username']))
				{
					//Benutzername darf nicht leer sein
					$template_data['fehler5'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];
					Template::render('newGame', $template_data);						
				}
				else
				{
					if (strlen($_REQUEST['username']) > 15)
					{
						//Benutzername darf nicht länger als 15 Zeichen sein.
						$template_data['fehler6'] = true;
						$template_data['Spiel'] = $_SESSION['Spiel'];
						Template::render('newGame', $template_data);						
					}
					else
					{				
						Session::create_user($_REQUEST['username'], $_REQUEST['password']);
						$_SESSION['anzahlSpieler']++;
						$spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
						$_SESSION['Spiel']->hinzufuegenSpieler($spieler);
						$_SESSION['Spiel']->persistiereSpiel();
						$s_id = Spiel::getLetztesSpielinDB();
						$_SESSION['Spiel']->setSId($s_id['s_id']);

						$i = 1;
						if (!empty($_SESSION['Spiel']->getSpieler())) foreach ($_SESSION['Spiel']->getSpieler() as $test) :
							Spielkarte::persistiereSpielkarte($test->getId(), $_SESSION['Spiel']->getSId(), $i);
							$sk_id = Spielkarte::getLetzteSpielkarteinDB();
							$_SESSION['Spiel']->getSpieler()[$i]->getSpielkarte()->setSkId($sk_id['sk_id']);
							$i = $i + 1;
						endforeach;

						$template_data['Spiel'] = $_SESSION['Spiel'];
						Template::render('actualGame', $template_data);
						
					}
				}
			}
		} else {
            if (Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
                $spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
				if ($_SESSION['Spiel']->istSpielerSchonAngemeldet($spieler))
				{
					//Spieler ist bereist Angemeldet
					$template_data['fehler4'] = true;
					$template_data['Spiel'] = $_SESSION['Spiel'];					
					Template::render('newGame', $template_data);					
				} else
				{
                $_SESSION['Spiel']->hinzufuegenSpieler($spieler);
                $_SESSION['Spiel']->persistiereSpiel();
				$s_id = Spiel::getLetztesSpielinDB();
				$_SESSION['Spiel']->setSId($s_id['s_id']);

                $i = 1;
                if (!empty($_SESSION['Spiel']->getSpieler())) foreach ($_SESSION['Spiel']->getSpieler() as $test) :
                    Spielkarte::persistiereSpielkarte($test->getId(), $_SESSION['Spiel']->getSId(), $i);
					$sk_id = Spielkarte::getLetzteSpielkarteinDB();
                    $_SESSION['Spiel']->getSpieler()[$i]->getSpielkarte()->setSkId($sk_id['sk_id']);
                    $i = $i + 1;
                endforeach;

                $template_data['Spiel'] = $_SESSION['Spiel'];
                Template::render('actualGame', $template_data);
				}
            } else {
                //Hat der Spieler auf Spielstarten geklickt, ohne dass ein Login-Name eingegebn wurde,
                //hat er vermutlich zuvor aus Versehen auf "weiterer Spieler" gedrückt und
                // das spiel wird gestartet, ohne einen zusätzlichen spieler hinzuzufügen
                if ($_SESSION['Spiel']->hatSpieler() && $_REQUEST['username'] == null) {
					$_SESSION['Spiel']->persistiereSpiel();
					$s_id = Spiel::getLetztesSpielinDB();
					$_SESSION['Spiel']->setSId($s_id['s_id']);

					$i = 1;
					if (!empty($_SESSION['Spiel']->getSpieler())) foreach ($_SESSION['Spiel']->getSpieler() as $test) :
						Spielkarte::persistiereSpielkarte($test->getId(), $_SESSION['Spiel']->getSId(), $i);
						$sk_id = Spielkarte::getLetzteSpielkarteinDB();
						$_SESSION['Spiel']->getSpieler()[$i]->getSpielkarte()->setSkId($sk_id['sk_id']);
						$i = $i + 1;
					endforeach;
                    $template_data['Spiel'] = $_SESSION['Spiel'];
                    Template::render('actualGame', $template_data);
                } else {
					if (SESSION::nutzerNichtVorhanden($_REQUEST['username']))
					{
						//Benutzer nicht vorhanden.
						$template_data['fehler2'] = true;
						$template_data['Spiel'] = $_SESSION['Spiel'];					
						Template::render('newGame', $template_data);
					}
					else
					{					
						//Benutzername und Passwort stimmen nicht überein, anzeige Selbe Maske mit Fehler
						$template_data['fehler'] = true;
						$template_data['Spiel'] = $_SESSION['Spiel'];
						Template::render('newGame', $template_data);
					}
				}	

            }
        }


    }
//Auf der Filter-Seite können Filter wieder entfernt werden.
if (isset($_POST[filter_entfernen])) {
    $alleSpiele = Spiel::getSpielListe();

    //Die Namen der Spieler zu allen Zeilen hinzufügen
    for ($i = 0; $i < count($alleSpiele); $i++) {
        $spieler = Spiel::getBenutzerZuSpiel($alleSpiele[$i]['s_id']);
        $alleSpiele[$i]['s1'] = $spieler[0]['username'];
        $alleSpiele[$i]['s2'] = $spieler[1]['username'];
        $alleSpiele[$i]['s3'] = $spieler[2]['username'];
        $alleSpiele[$i]['s4'] = $spieler[3]['username'];
    }

    $template_data['filter'] = array();
    $template_data['spiele'] = $alleSpiele;
    Template::render('continueGameFilter', $template_data);
}

//Filter wird auf der Filterseite angewendet
if (isset($_POST[filter_anwenden])) {
    //alle SPiele aus der Datenbank
    $alleSpiele = Spiel::getSpielListe();
    //Nur die SPiele, die nach filterung angezeigt werden
    $spiele = array();
    //Die gesetzten Filter
    $filter = array();

    $spielID = $_REQUEST['spielid'];
    $datum = $_REQUEST['spieldatum'];
    $anzspieler = $_REQUEST['anzSpieler'];
    $s1 = $_REQUEST['spieler1'];
    $s2 = $_REQUEST['spieler2'];
    $s3 = $_REQUEST['spieler3'];
    $s4 = $_REQUEST['spieler4'];


    for ($i = 0; $i < count($alleSpiele); $i++) {
        //Die Namen der Spieler zu allen Zeilen hinzufügen
        $spieler = Spiel::getBenutzerZuSpiel($alleSpiele[$i]['s_id']);
        $alleSpiele[$i]['s1'] = $spieler[0]['username'];
        $alleSpiele[$i]['s2'] = $spieler[1]['username'];
        $alleSpiele[$i]['s3'] = $spieler[2]['username'];
        $alleSpiele[$i]['s4'] = $spieler[3]['username'];


        //Prüfen, ob Zeile den Filtern entspricht
        $idmatch = false;
        $datmatch = false;
        $anzmatch = false;
        $s1match = false;
        $s2match = false;
        $s3match = false;
        $s4match = false;

        try {
            new DateTime($alleSpiele[$i]['Startdatum']);
            new DateTime($datum);
        } catch (Exception $e) {
            $datum = null;
        }


        if (($spielID != null && $alleSpiele[$i]['s_id'] == $spielID) || $spielID == null) {
            $idmatch = true;
        }
        if (($datum != null && new Datetime($alleSpiele[$i]['Startdatum']) == new Datetime($datum)) || $datum == null) {
            $datmatch = true;
        }
        if (($anzspieler != null && $alleSpiele[$i]['anz'] == $anzspieler) || $anzspieler == null) {
            $anzmatch = true;
        }
        if (($s1 != null && $alleSpiele[$i]['s1'] == $s1) || $s1 == null) {
            $s1match = true;
        }
        if (($s2 != null && $alleSpiele[$i]['s2'] == $s2) || $s2 == null) {
            $s2match = true;
        }
        if (($s3 != null && $alleSpiele[$i]['s3'] == $s3) || $s3 == null) {
            $s3match = true;
        }
        if (($s4 != null && $alleSpiele[$i]['s4'] == $s4) || $s4 == null) {
            $s4match = true;
        }

        if ($idmatch && $datmatch && $anzmatch && $s1match && $s2match && $s3match && $s4match) {
            $spiele[$i] = $alleSpiele[$i];
        }

    }
    $filter['id'] = $spielID;
    $filter['dat'] = $datum;
    $filter['anz'] = $anzspieler;
    $filter['s1'] = $s1;
    $filter['s2'] = $s2;
    $filter['s3'] = $s3;
    $filter['s4'] = $s4;

    $template_data['filter'] = $filter;
    $template_data['spiele'] = $spiele;
    Template::render('continueGameFilter', $template_data);
}


//Verzweigung auf der continueGameFilter Seite mit den Buttons Spiel fortsetzen und Hauptmenü
//continue Game Filter -> "Spiel fortsetzen" Button
if (isset($_POST[spiel_fortsetzen])) {
    //$_SESSION['Spiel'] = new Spiel();
	if (is_null($_REQUEST['werte']))
	{
		$alleSpiele = Spiel::getSpielListe();

        //Die Namen der Spieler zu allen Zeilen hinzufügen
        for ($i = 0; $i < count($alleSpiele); $i++) {
            $spieler = Spiel::getBenutzerZuSpiel($alleSpiele[$i]['s_id']);
            $alleSpiele[$i]['s1'] = $spieler[0]['username'];
            $alleSpiele[$i]['s2'] = $spieler[1]['username'];
            $alleSpiele[$i]['s3'] = $spieler[2]['username'];
            $alleSpiele[$i]['s4'] = $spieler[3]['username'];
        }

        $template_data['filter'] = array();
        $template_data['spiele'] = $alleSpiele;
		$template_data['fehler'] = true;
        Template::render('continueGameFilter', $template_data);
	}
	else
	{
    $_SESSION['Spiel']->getSpiel($_REQUEST['werte']);
    $_SESSION['anzahlEinzuloggenderSpieler'] = Spiel::getAnzahlSpieler($_SESSION['Spiel']->getSId())[0][anz];
    $_SESSION['anzahlEingeloggterSpieler'] = 0;

// Hier wird der erste Spieler des fortzusetzenden Spieles übergeben um ihn einzuloggen
    $_SESSION['benutzer'] = Spiel::getBenutzerZuSpiel($_SESSION['Spiel']->getSId())[$_SESSION['anzahlEingeloggterSpieler']][username];
    $template_data['benutzer'] = $_SESSION['benutzer'];
	if ($_SESSION['anzahlEingeloggterSpieler'] >= ($_SESSION['anzahlEinzuloggenderSpieler']-1))
	{
		$template_data['naechsterSpieler'] = true;
	}
    Template::render('continueGameLogin', $template_data);
	}
}

//Verzweigung auf der continueGameLogin Seite mit den Buttons Nächster Spieler/Spiel fortsetzen und Hauptmenü

if (isset($_POST[spiel_weiter])) {

    if (Session::check_credentials($_SESSION['benutzer'], $_REQUEST['password'])) {

        $_SESSION['anzahlEingeloggterSpieler']++;
        $spieler = new Spieler(Benutzer::getIdZuNamen($_SESSION['benutzer']), $_SESSION['benutzer']);
        $spieler->getSpielkarte()->fetchSpielkarte($spieler->getId(), $_SESSION['Spiel']->getSId());
        $_SESSION['Spiel']->hinzufuegenSpieler($spieler);

        $template_data['Spiel'] = $_SESSION['Spiel'];


        if ($_SESSION['anzahlEingeloggterSpieler'] < $_SESSION['anzahlEinzuloggenderSpieler']) {

            $_SESSION['benutzer'] = Spiel::getBenutzerZuSpiel($_SESSION['Spiel']->getSId())[$_SESSION['anzahlEingeloggterSpieler']][username];
            $template_data['benutzer'] = $_SESSION['benutzer'];
			if ($_SESSION['anzahlEingeloggterSpieler'] >= ($_SESSION['anzahlEinzuloggenderSpieler']-1))
			{
				$template_data['naechsterSpieler'] = true;
			}
            Template::render('continueGameLogin', $template_data);

        } else {

            $template_data['Spiel'] = $_SESSION['Spiel'];
            Template::render('actualGame', $template_data);
        }


    } else {
		//Benutzername und Passwort stimmen nicht überein, anzeige Selbe Maske mit Fehler
		$template_data['fehler'] = true;
		$template_data['benutzer'] = $_SESSION['benutzer'];
	    Template::render('continueGameLogin', $template_data);
    }
}

//Spiel beenden auf der Spielseite
if (isset($_POST[spiel_beenden])) {
    SESSION::logout();
    $spiel = new Spiel();
    $_SESSION['Spiel'] = $spiel;
    $template_data['Spiel'] = $_SESSION['Spiel'];
    $_SESSION['anzahlSpieler'] = 0;
	$template_data['ScoreListe'] = Ranking::getScoreListe();
    Template::render('start', $template_data);
}

if (!SESSION::gestartet() || empty($_POST)) {
    $spiel = new Spiel();
    $_SESSION['Spiel'] = $spiel;
    $template_data['Spiel'] = $_SESSION['Spiel'];
    $_SESSION['anzahlSpieler'] = 0;
    $template_data['ScoreListe'] = Ranking::getScoreListe();
    Template::render('start', $template_data);
}

//Würfeln auf der actualGame Seite
if (isset($_POST[wuerfeln])) {

    $_SESSION['Spiel']->getWuerfelspiel()->wuerfeln();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);

}

//Würfel auf die Bank und wieder zurück setzen.

if (isset($_POST[wuerfel1])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(1);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel2])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(2);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel3])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(3);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel4])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(4);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel5])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(5);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank1])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(1);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank2])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(2);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank3])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(3);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank4])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(4);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank5])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(5);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[einer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setEiner($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[zweier])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setZweier($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[dreier])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setDreier($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[vierer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setVierer($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[fuenfer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setFuenfer($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[sechser])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setSechser($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[dreierpasch])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setDreierpasch($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[viererpasch])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setViererpasch($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[fullhouse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setFullHouse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[kleinestrasse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setKleineStrasse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[grossestrasse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setGrosseStrasse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[kniffel])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setKniffel($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}

if (isset($_POST[chance])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setChance($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    Template::render('actualGame', $template_data);
}



/*

TODO:

*/
