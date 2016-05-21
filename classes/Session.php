<?php

class Session {
    public static function check_credentials($user, $password)
    {
			$passwordDatenbank = Benutzer::getNutzerdaten($user);

			if (password_verify($password, $passwordDatenbank)) 
			{
				return true;
			} else 
			{
				return false;
			}

    }

    public static function gestartet()
    {
        return ($_SESSION['gestartet'] === true);
    }

    public static function logout()
    {
        // destroy old session
        session_destroy();

        // immediately start a new one
        session_start();

        // create new session_id
        session_regenerate_id(true);
		
		// session starten
		$_SESSION['gestartet'] = true;
    }

    public function create_user($user, $password)
    {

       // erstellen eines neuen Accounts
            			
		$hash =  password_hash($password, PASSWORD_DEFAULT);
		Benutzer::createUser(array(
		'username' 	=> $user,
		'passwort'  => $hash
		));
			
    }
	
	    public static function starten()
    {
        $_SESSION['gestartet'] = true;
    }

    public static function authenticated()
    {
        return ($_SESSION['logged_in'] === true);
    }
	
	
	public static function nutzerNichtVorhanden($user, $password)
    {
		$stmt = Benutzer::usernameVorhanden($user);
		
		if ($stmt == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
    }
	
	
	
}
