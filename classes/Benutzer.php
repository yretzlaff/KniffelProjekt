<?php

class Benutzer
{
    public static function createUser($nutzerdaten)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("INSERT INTO user(username, password) VALUES (:username,:passwort) ");
		
		$stmt->execute($nutzerdaten);
		
    }
	
	public static function getNutzerdaten($username)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("SELECT password FROM user WHERE username = :username");
		
		$user = array
		(
				username => $username
		);
		
		$stmt->execute($user);
		
		return $stmt->fetch;
		
    }
	
	public static function usernameVorhanden($username)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("SELECT * FROM user WHERE username = :username");
		
		$user = array
		(
				username => $username
		);
		
		$stmt->execute($user);
		
		return $stmt->fetchColumn();
		
    }
	
	public static function userNichtExistent($username)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("SELECT username FROM user WHERE username = :username");
		
		$user = array
		(
				username => $username
		);
		
		$stmt->execute($user);
		
		return $stmt->fetchColumn();
		
    }

	public static function getIdZuNamen($username)
	{

		global $dbh;

		$stmt = $dbh->prepare("SELECT id FROM user WHERE username = :username");

		$user = array
		(
			username => $username
		);

		$stmt->execute($user);

		return $stmt->fetchColumn();


	}

}
