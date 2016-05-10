<?php

class Benutzer
{
    public static function createUser($nutzerdaten)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("INSERT INTO user(username, password) VALUES (:username,:passwort) ");
		
		$stmt->execute($nutzerdaten);
		
    }


}
