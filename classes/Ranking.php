<?php

class Ranking
{

	public static function getScoreListe()
	{
        global $dbh;

        $stmt = $dbh->prepare("Select ID, Username, spielerscore
							   From User
							   Order by Spielerscore DESC
							   Limit 10;"
							 );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getPunkteListe()
	{
        global $dbh;

        $stmt = $dbh->prepare("Select Username, (summe_unten + Summe_oben) As Gesamtpunktzahl
							   From User, Spielkarte
							   Where Spielkarte.u_id = user.id
							   order by (summe_unten + Summe_oben) DESC
							   Limit 10;"
							 );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getMeistenSiege()
	{
        global $dbh;

        $stmt = $dbh->prepare("SELECT C.U_id, E.Username, Count(C.s_id) As Anzahl
							   From (Select A.s_id, B.sk_id, B.u_id
									 From (SELECT s_id, MAX(summe_oben + summe_unten) AS Summe
										   From spielkarte
										   GROUP by s_id
										  ) AS A,
										  spielkarte AS B
								     Where B.s_id = A.s_id
									  and (B.summe_oben + B.summe_unten) = A.Summe
									)AS C,
									Spiele AS D,
									User AS E
							   Where E.id = C.U_id
								and  D.s_id = C.s_id
								and  D.beendet is Not null

							   Group by C.U_id, E.Username
							   Order by Count(C.s_id) DESC
							   Limit 10"
							 );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	


}
		