<?php

class Spiel
{
    public static function getBenutzerZuSpiel()
    {
        global $dbh;

		$stmt = $dbh->prepare("SELECT username FROM user, spiele, spielkarte WHERE user.id=u_id AND spielkarte.s_id = spiele.s_id AND beendet is null ");
		
		$stmt->execute();
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
