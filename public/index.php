<?php

	require_once '../config.php';

	// initialize variables
	$template_data = array();
	$anzahlSpieler = 0;

	Template::render('newGame', $template_data);
	
	if (isset($_POST[neues_spiel]))
	{
		Template::render('newGame', $template_data);
	}
	else
	if (isset($_POST[spiel_fortsetzen])){
		$template_data['benutzer'] = Spiel::getBenutzerZuSpiel();
		Template::render('continueGameLogin', $template_data);
	}


    if (isset($_POST[weiterer_spieler])){
		if (anzahlSpieler < 4)
		{
			if (isset($_REQUEST['add_user']))
			{
				Session::create_user($_REQUEST['username'],$_REQUEST['password']);
			}
			$anzahlSpieler = $anzahlSpieler + 1;
			Template::render('newGame', $template_data);
		}
		else
		{
			//fehlermeldung
		}
	}
    else

    if (isset($_POST[spiel_starten])){
		$anzahlSpieler = 0;
        Template::render('continueGameLogin', $template_data);
    }
	else
		
	if (isset($_POST[abbrechen])){
		$anzahlSpieler = 0;
		Template::render('start', $template_data);
	}

/*

TODO:

*/
