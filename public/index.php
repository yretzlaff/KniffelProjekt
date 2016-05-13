<?php

	require_once '../config.php';

	// initialize variables
	$template_data = array();
	
	//Verzweigung auf der Startseite mit den Buttons Neues Spiel und Spiel fortsetzen
	if (isset($_POST[newGame]))
	{
		SESSION::starten();
		Template::render('newGame', $template_data);
	}
	else
	if (isset($_POST[continueGame])){
		SESSION::starten();
		Template::render('continueGameFilter', $template_data);
	}


	//Verzweigung auf der Neues Spiel Seite mit den Buttons Weiterer Spieler, Spiel starten und Abbrechen
    if (isset($_POST[weiterer_spieler])){
		if ($_SESSION['anzahlSpieler'] < 4)
		{
			if (isset($_REQUEST['add_user']))
			{
				Session::create_user($_REQUEST['username'],$_REQUEST['password']);
				$_SESSION['anzahlSpieler']++; 
				Template::render('newGame', $template_data);
			}
			else
			{
				if (Session::check_credentials($_REQUEST['username'],$_REQUEST['password']))
				{
					$_SESSION['anzahlSpieler']++;
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

    if (isset($_POST[spiel_starten])){
        Template::render('actualGame', $template_data);
    }
	else
		
	if (isset($_POST[abbrechen])){
		$_SESSION['anzahlSpieler'] = 0;
		Template::render('start', $template_data);
	}
	
	//Verzweigung auf der continueGameFilter Seite mit den Buttons Spiel fortsetzen und Hauptmenü
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
		$_SESSION['anzahlSpieler'] = 0;
		Template::render('start', $template_data);
	}

/*

TODO:

*/
