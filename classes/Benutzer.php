﻿<?php

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
		
		return $stmt->fetchColumn();
		
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
	
	public static function changeUsername($id, $username)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("UPDATE user SET username = :username WHERE id = :id");
		
		$user = array
		(
			username 	=> $username,
			id			=> $id

		);
		
		$stmt->execute($user);
		
    }

	public static function changePassword($id, $hash)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("UPDATE user SET password = :hashPasswort WHERE id = :id");
		
		$user = array
		(
			hashPasswort	=> $hash,
			id				=> $id

		);
		
		$stmt->execute($user);
		
    }	

	public static function deleteAccount($id)
    {
        global $dbh;
		
		$stmt = $dbh->prepare("DELETE FROM user WHERE id = :id");
		
		$user = array
		(
			id				=> $id
		);
		
		$stmt->execute($user);
		
    }		
}
