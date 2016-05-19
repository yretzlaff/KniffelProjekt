<?php

	require_once '../config.php';


	// initialize variables
	$template_data = array();

	
	//Verzweigung auf der Startseite mit den Buttons Neues Spiel und Spiel fortsetzen
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


	//Verzweigung auf der Neues Spiel Seite mit den Buttons Weiterer Spieler, Spiel starten und Abbrechen
	//neues Spiel -> "Weiterer Spieler" Button
    if (isset($_POST[weiterer_spieler])){
		if ($_SESSION['anzahlSpieler'] < 4)
		{
			if (isset($_REQUEST['add_user']))
			{
				Session::create_user($_REQUEST['username'],$_REQUEST['password']);
				$_SESSION['anzahlSpieler']++; 
				$spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']),$_REQUEST['username']);
				$template_data['Spiel']->hinzufuegenSpieler($spieler);
				Template::render('newGame', $template_data);
			}
			else
			{
				if (Session::check_credentials($_REQUEST['username'],$_REQUEST['password']))
				{
					$_SESSION['anzahlSpieler']++;
					$spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']),$_REQUEST['username']);
					$template_data['Spiel']->hinzufuegenSpieler($spieler);
					Template::render('newGame', $template_data);
				}
				else
				{
					throw new Exception('Benutzername und Password stimmen nicht überein!');
				}
			}
		}
		else
		{
			throw new Exception('Es können maximal 4 Spieler an einem Spiel teilnehmen!');
		}
	}
    else
		
	// neues Spiel -> "Spiel starten" Button	
    if (isset($_POST[spiel_starten])){
		$spieler = new Spieler(Benutzer::getIdZuNamen($_REQUEST['username']),$_REQUEST['username']);
		$_SESSION['Spiel']->hinzufuegenSpieler($spieler);
		$template_data['Spiel'] = $_SESSION['Spiel'];
		//print_r($spiel);
        Template::render('actualGame', $template_data);
    }
	else
		
	// neues Spiel -> "Abbrechen" Button	
	if (isset($_POST[abbrechen])){
		$_SESSION['anzahlSpieler'] = 0;
		Template::render('start', $template_data);
	}
	
	//Verzweigung auf der continueGameFilter Seite mit den Buttons Spiel fortsetzen und Hauptmenü
	//continue Game Filter -> "Spiel fortsetzen" Button
	if (isset($_POST[spiel_fortsetzen]))
	{
		$template_data['benutzer'] = Spiel::getBenutzerZuSpiel();
		Template::render('continueGameLogin', $template_data);
	}
	else
	if (isset($_POST[hauptmenue]))
	{
		Template::render('start', $template_data);
	}
	
	//Verzweigung auf der continueGameLogin Seite mit den Buttons Nächster Spieler, Spiel fortsetzen und Hauptmenü
	if (isset($_POST[naechster_spieler]))
	{
		Template::render('continueGameLogin', $template_data);
	}
	else
	if (isset($_POST[spiel_fortsetzen2]))
	{
		Template::render('actualGame', $template_data);
	}
	else
	if (isset($_POST[hauptmenue2]))
	{
		Template::render('start', $template_data);
	}	
	
	//Spiel beenden auf der Spielseite
	if (isset($_POST[spiel_beenden]))
	{
		$_SESSION['anzahlSpieler'] = 0;
		Template::render('start', $template_data);
	}
	
	if (!SESSION::gestartet() || empty($_POST))
	{
		$spiel = new Spiel();
		$_SESSION['Spiel'] = $spiel;
		$template_data['Spiel'] = $_SESSION['Spiel'];
		$_SESSION['anzahlSpieler'] = 0;
		Template::render('start', $template_data);
	}

	if (isset($_POST[wuerfeln]))
	{

		$_SESSION['Spiel']->getWuerfelspiel()->wuerfeln();
		$template_data['Spiel'] = $_SESSION['Spiel'];
		print_r($template_data['Spiel']);
		Template::render('actualGame', $template_data);

	}

/*

TODO:

*/
