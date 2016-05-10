<?php

class Spiel
{
    public static function getBenutzerZuSpiel()
    {
        global $dbh;
		$usernamen = array();
		$qry = mysql_query("SELECT username FROM user, spiele, spielkarte WHERE user.id=u_id AND spielkarte.s_id = spiele.s_id AND beendet is null ");
		
		while($reihe = mysql_fetch_array($qry))
		{
			$usernamen = $reihe['username'];
		}
		return $usernamen;
    }


}
