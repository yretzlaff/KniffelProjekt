<?php


	require_once '../config.php';


	// initialize variables
	$template_data = array();


    //Aufruf des Hauptmenüs
    if (isset($_POST[hauptmenue]))
    {
        $_SESSION['anzahlSpieler'] = 0;
        $template_data['ScoreListe'] = Ranking::getScoreListe();
        Template::render('start', $template_data);
    }
	//Verzweigung auf der Startseite mit den Buttons Neues Spiel, Spiel fortsetzen und Benutzerverwaltung
	//start -> "Neues Spiel" Button
	if (isset($_POST[newGame]))
	{
		SESSION::starten();
		Template::render('newGame', $template_data);
	}
	else
		//start -> "Spiel fortsetzen" Button	
	if (isset($_POST[continueGame])){
		SESSION::starten();
		$template_data['filter'] = Spiel::getSpielListe();
		Template::render('continueGameFilter', $template_data);
		
	}
	else
        //start -> "Ranking aufrufen" Button
        if (isset($_POST[callRanking]))
        {
            $template_data['WinListe'] = Ranking::getMeistenSiege();
            $template_data['PunkteListe'] = Ranking::getPunkteListe();
            Template::render('moreRankings', $template_data);
        }

		//start -> "Benutzerverwaltung" Button
	if (isset($_POST[nutzerVerwaltung])){
		SESSION::starten();
		Template::render('login', $template_data);
	}
	
	//Verzweigung auf der Login Seite mit den Buttons Login und Abbrechen
	if (isset($_POST[login])){
		if (Session::check_credentials($_REQUEST['username'],$_REQUEST['password']))
			{
				$_SESSION['user'] = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']),$_REQUEST['username']);
				Template::render('userEdit',$template_data);
			}
			else
			{
				throw new Exception('Benutzername und Passwort stimmen nicht überein!');
			}
	}

	//Verzweigung auf der Nutzerverwaltungsseite mit den Buttons Nutzername ändern, Passwort ändern, Account löschen und 

	if (isset($_POST[namenAendern])){
		$template_data['user'] = $_SESSION['user'];
		Template::render('changeUsername', $template_data);
	}
	else
	
	if (isset($_POST[passwortAendern])){
		Template::render('changePassword', $template_data);
	}
	else
		
	if (isset($_POST[nutzerLoeschen])){
		Template::render('start', $template_data);
	}
	
	//Verzweigung auf der Username ändern Seite mit den Buttons Bestätigen und Abbrechen
	if (isset($_POST[bestaetigenUsername])){
		$_SESSION['user']->setName($_REQUEST[neuerUsername]);
		Template::render('userEdit', $template_data);
	}
	
	//Verzweigung auf der Passwort ändern Seite mit den Buttons Bestätigen und Abbrechen
	if(isset($_POST[bestaetigenPasswort])){
		Template::render('userEdit', $template_data);
	}
		
	if (isset($_POST[abbrechen])){
		Template::render('userEdit', $template_data);
	}

//Verzweigung auf der Neues Spiel Seite mit den Buttons Weiterer Spieler, Spiel starten und Abbrechen
//neues Spiel -> "Weiterer Spieler" Button
if (isset($_POST[weiterer_spieler])) {
    if ($_SESSION['anzahlSpieler'] < 4) {
        if (isset($_REQUEST['add_user'])) {
            Session::create_user($_REQUEST['username'], $_REQUEST['password']);
            $_SESSION['anzahlSpieler']++;
            $spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
            $_SESSION['Spiel']->hinzufuegenSpieler($spieler);
            $template_data['Spiel'] = $_SESSION['Spiel'];
            Template::render('newGame', $template_data);
        } else {
            if (Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
                $_SESSION['anzahlSpieler']++;
                $spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
                $_SESSION['Spiel']->hinzufuegenSpieler($spieler);
                $template_data['Spiel'] = $_SESSION['Spiel'];
                Template::render('newGame', $template_data);
            } else {
                throw new Exception('Benutzername und Password stimmen nicht überein!');
            }
        }
    } else {
        throw new Exception('Es können maximal 4 Spieler an einem Spiel teilnehmen!');
    }
} else

    // neues Spiel -> "Spiel starten" Button
    if (isset($_POST[spiel_starten])) {
        if (Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
            $spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']), $_REQUEST['username']);
            $_SESSION['Spiel']->hinzufuegenSpieler($spieler);
            $_SESSION['Spiel']->persistiereSpiel();
            $_SESSION['Spiel']->setSId(Spiel::getLetztesSpielinDB());

            $i = 1;
            if (!empty($_SESSION['Spiel']->getSpieler())) foreach ($_SESSION['Spiel']->getSpieler() as $test) :
                Spielkarte::persistiereSpielkarte($test->getId(), $_SESSION['Spiel']->getSId()[0][s_id], $i);
                $_SESSION['Spiel']->getSpieler()[$i]->getSpielkarte()->setSkId(Spielkarte::getLetzteSpielkarteinDB());
                $i = $i + 1;
            endforeach;

            $template_data['Spiel'] = $_SESSION['Spiel'];
            Template::render('actualGame', $template_data);
        }
        else{
            throw new Exception('Benutzername und Password stimmen nicht überein!');
        }


    } else

        // neues Spiel -> "Abbrechen" Button
        if (isset($_POST[abbrechen])) {
            $_SESSION['anzahlSpieler'] = 0;
            Template::render('start', $template_data);
        }

//Verzweigung auf der continueGameFilter Seite mit den Buttons Spiel fortsetzen und Hauptmenü
//continue Game Filter -> "Spiel fortsetzen" Button
if (isset($_POST[spiel_fortsetzen])) {
    $template_data['benutzer'] = Spiel::getBenutzerZuSpiel();
    Template::render('continueGameLogin', $template_data);
}

//Verzweigung auf der continueGameLogin Seite mit den Buttons Nächster Spieler, Spiel fortsetzen und Hauptmenü
if (isset($_POST[naechster_spieler])) {
    Template::render('continueGameLogin', $template_data);
} else
    if (isset($_POST[spiel_fortsetzen2])) {
        Template::render('actualGame', $template_data);
    }

//Spiel beenden auf der Spielseite
if (isset($_POST[spiel_beenden])) {
    $_SESSION['anzahlSpieler'] = 0;
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

if (isset($_POST[wuerfeln])) {

    $_SESSION['Spiel']->getWuerfelspiel()->wuerfeln();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']);
    Template::render('actualGame', $template_data);

}


if (isset($_POST[wuerfel1])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(1);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel2])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(2);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel3])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(3);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel4])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(4);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[wuerfel5])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBank(5);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank1])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(1);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank2])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(2);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank3])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(3);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank4])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(4);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[bank5])) {
    $_SESSION['Spiel']->getWuerfelspiel()->moveToBecher(5);
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[einer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setEiner($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[zweier])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setZweier($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[dreier])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setDreier($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[vierer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setVierer($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[fuenfer])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setFuenfer($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[sechser])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setSechser($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[dreierpasch])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setDreierpasch($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[viererpasch])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setViererpasch($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[fullhouse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setFullHouse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[kleinestrasse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setKleineStrasse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[grossestrasse])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setGrosseStrasse($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[kniffel])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setKniffel($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}

if (isset($_POST[chance])) {
    $_SESSION['Spiel']->getSpieler()[$_SESSION['Spiel']->getAktuellerSpieler()]->getSpielkarte()->setChance($_SESSION['Spiel']->getWuerfelspiel()->getWuerfel());
    $_SESSION['Spiel']->naechsterSpieler();
    $template_data['Spiel'] = $_SESSION['Spiel'];
    print_r($template_data['Spiel']->getWuerfelspiel());
    Template::render('actualGame', $template_data);
}



/*

TODO:

*/
