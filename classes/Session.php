<?php

class Session {
    public static function check_credentials($user, $password)
    {
		$stmt = Benutzer::usernameVorhanden($user);
		
		if ($stmt == 0)
		{
			throw new Exception('Benutzer nicht vorhanden. Überprüfen Sie den Nutzernamen oder erstellen Sie einen neuen Nutzer!');
		}
		else
		{
			$password = Benutzer::getNutzerdaten($user);

			$hash = password_hash($password, PASSWORD_DEFAULT);

			if (password_verify($password, $hash)) {
				$_SESSION['logged_in'] = true;
				$_SESSION['user'] = $user;



				return true;
			}
		}
		return false;
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
    }

    public function create_user($user, $password)
    {

        $stmt = Benutzer::usernameVorhanden($user);


        if ($stmt == 0) {         // user does not yet exists, create it
            			
				$hash =  password_hash($password, PASSWORD_DEFAULT);
				Benutzer::createUser(array(
					'username' 	=> $user,
					'passwort'  => $hash
				));
			

         /**   $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;

            // create new session_id
            session_regenerate_id(true);**/
        } else {
            throw new Exception('Benutzername bereits vorhanden. Bitte wählen Sie einen anderen!');
        }
    }
	
	    public static function starten()
    {
        $_SESSION['gestartet'] = true;
    }
}
