<?php

class Spiel
{
    //Abhängig von der ANzahl der Zeilen auf einer Spielkarte (aktuell 13)
    const MAXANZAHLRUNDEN = 13;

    //Liste der Spieler mit ihren Spielkarten
    private $spieler = array();

    //Würfelspiel um einen Würfelvorgang zu simulieren
    private $wuerfelspiel;

    //Zustände des Spiels
    private $aktuellerSpieler = 0;
    private $aktuelleRunde = 0;
	private $beendet = false;

    private $s_id = 0;

    /*
     * Konstrukor zur instanziierung eines Spiel-Objektes
     */
    public function __construct()
    {
        //Require_Once zum Laden der Klassen in den Ausführungskontext. Ist quasi wie Import in Java
        require_once("Spieler.php");
        require_once("WuerfelSpiel.php");
        require_once("Punkterechner.php");
        

        //Erzeuge neues Würfelspiel
        $this->wuerfelspiel = new WuerfelSpiel();

        //Setze den ersten Spieler
        $this->aktuellerSpieler = 1;
        $this->aktuelleRunde = 1;
    }
	


    /*
     * Wechsel zum nächsten Spieler und erzeuge einen neues Würfelspiel
     */
    public function naechsterSpieler()
    {
        $this->setDerzeitigerSpieler($this->getAktuellerSpieler()+1);
        if ($this->getAktuellerSpieler() > count($this->spieler)) {
            $this->setDerzeitigerSpieler(1);
            $this->naechsteRunde();
        }
		$this->persistiereSpieler();
        $this->wuerfelspiel = new WuerfelSpiel();
    }

    /*
     * Wechsel in die nächste Runde. Sind alle runden gespielt rufe spielBeenden() auf.
     */
    public function naechsteRunde()
    {
        $this->setAktuelleRunde($this->getAktuelleRunde()+1);
		print_r($this->getAktuelleRunde());
		$this->persistiereRunde();
        if ($this->getAktuelleRunde > Spiel::MAXANZAHLRUNDEN) {
            $this->spielBeenden();
        }
    }

    /*
     * Methode um das Spiel zu beenden
     */
    public function spielBeenden()
    {
        global $dbh;
		
		$stmt = $dbh->prepare("UPDATE spiele SET beendet = 1 WHERE s_id = :s_id");
		
		$spiel = array
		(
				s_id => $this->s_id[0][s_id]
		);

		$stmt->execute($spiel);
		$this->setBeendet(true);
        foreach ($this->getSpieler() AS $spieler):
            print_r($spieler->getSpielkarte()->getSkId());
            $spieler->getSpielkarte()->persistiereSummeOben();
            $spieler->getSpielkarte()->persistiereSummeUnten();
            
            
        endforeach;    
    }

    /*
     * Methode um zu überprüfen ob Spiel beendet ist
     */
    public function istBecherVerschiebbar($w)
    {
        if ($this->getBeendet() == 1 || !$this->getWuerfelspiel()->hatgewürfelt() || null == $this->getWuerfelspiel()->getBecher()[$w] || null == $this->getWuerfelspiel()->getBecher()[$w]->getWert())
        {
            return "disabled";
        }
        else
        {
            return "";
        }
    }

    /*
     * Methode um zu überprüfen ob Spiel beendet ist
     */
    public function istBankVerschiebbar($w)
    {
        if ($this->getBeendet() == 1 || !$this->getWuerfelspiel()->hatgewürfelt() || null == $this->getWuerfelspiel()->getBank()[$w] || null == $this->getWuerfelspiel()->getBank()[$w]->getWert())
        {
            return "disabled";
        }
        else
        {
            return "";
        }
    }

    public function istWuerfelbar()
    {
        if ($this->getBeendet() == 1)
        {
            return "disabled";
        }
        else
        {
            return "";
        }
    }
	
    /*
     * Methode um Werte des Spiel Objektes entsprechend den Werten aus der Datenbank zu setzen
     */
    public function getSpiel($s_id)
    {
		$spiel = Spiel::getSpielausDB($s_id);

		$this->setSId($spiel[0][s_id]);
		$this->setDerzeitigerspieler($spiel[0][derzeitiger_spieler]);
		$this->setAktuelleRunde($spiel[0][aktuelle_runde]);
		$this->getSpielerAusDB($s_id);
    }
	
	/*
     * Methode um dem Spiel die teilnehmenden Spieler hinzuzufügen (wird verwendet bei spiel fortsetzten)
     */
    public function getSpielerZuSpiel($s_id)
    {
		$spiel = Spiel::getSpielerAusDB($s_id);
		foreach ($spiel as $spieler)
		{
			$spielerHinzu = new Spieler($spieler['id'],$spieler['username']);
			$this->hinzufuegenSpieler($spielerHinzu);
		}
		$this->setSId($spiel['s_id']);
		$this->setDerzeitigerspieler($spiel['derzeitiger_spieler']);
		$this->setAktuelleRunde($spiel['aktuelle_runde']);
    }
	
    /*
     * Methode um neue Spieler hinzuzufügen
     */
    public function hinzufuegenSpieler($neuerspieler)
    {
        $this->spieler[count($this->spieler) + 1] = $neuerspieler;
    }

    public function getSpieler()
    {
        return $this->spieler;
    }

    public function getAktuellerSpieler()
    {
        return $this->aktuellerSpieler;
    }

    public function getWuerfelspiel()
    {
        return $this->wuerfelspiel;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }
	
    public function setDerzeitigerspieler($derzeitigierSpieler)
    {
        $this->aktuellerSpieler = $derzeitigierSpieler;
    }
	
    public function setAktuelleRunde($aktuelleRunde)
    {
        $this->aktuelleRunde = $aktuelleRunde;
    }
	
	public function getAktuelleRunde()
    {
        return $this->aktuelleRunde;
    }
	
    public function setBeendet($beendet)
    {
        $this->beendet = $beendet;
    }

    public function getBeendet()
    {
        return $this->beendet;
    }

	
    /*
     * Testmethode zur Simulation eines Spiels
     */
    public function spielen()
    {
        $this->wuerfelspiel->wuerfeln();
        $this->wuerfelspiel->moveToBank(1);
        $this->wuerfelspiel->moveToBank(3);
        $this->wuerfelspiel->wuerfeln();
        $this->wuerfelspiel->moveToBank(2);
        $this->wuerfelspiel->moveToBank(4);
        $this->wuerfelspiel->wuerfeln();
        $this->wuerfelspiel->printBecher();
        $this->wuerfelspiel->printBank();
        $this->spieler[$this->aktuellerSpieler]->getSpielkarte()->setVierer($this->wuerfelspiel->getWuerfel());
        echo("<br />\nVierer-Punkte: " . $this->spieler[$this->aktuellerSpieler]->getSpielkarte()->getVierer());
        $this->naechsterSpieler();
        $this->wuerfelspiel->printBecher();
    }


    public static function getBenutzerZuSpiel($spiel)
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT username FROM user, spiele, spielkarte WHERE user.id=u_id AND spielkarte.s_id = spiele.s_id AND beendet is null AND spiele.s_id = :spiel ");

		$spielArr = array
		(
				spiel => $spiel
		);
		
        $stmt->execute($spielArr);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSpielListe()
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT spiele.s_id, Startdatum, COUNT(sk_id) AS anz FROM `spiele` LEFT JOIN `spielkarte` ON spiele.s_id = spielkarte.s_id WHERE spiele.beendet IS NULL GROUP BY spiele.s_id, Startdatum");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
    public static function getAnzahlSpieler($spiel)
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT COUNT(sk_id) AS anz FROM `spiele` LEFT JOIN `spielkarte` ON spiele.s_id = spielkarte.s_id WHERE spiele.beendet IS NULL AND spiele.s_id = :spiel ");

		$spielArr = array
		(
				spiel => $spiel
		);
		
        $stmt->execute($spielArr);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function persistiereSpiel(){

        global $dbh;

        $stmt = $dbh->prepare("INSERT INTO `spiele`(`Startdatum`, `Derzeitiger_Spieler`, `Aktuelle_Runde`) VALUES (NOW(),1,1)");

        $stmt->execute();
    }



    public static function getLetztesSpielinDB()
	{

        global $dbh;

        $stmt = $dbh->prepare("SELECT s_id FROM `spiele` ORDER BY s_id DESC LIMIT 1 ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
	
	public static function getSpielausDB($id)
	{

        global $dbh;

        $stmt = $dbh->prepare("SELECT s_id, derzeitiger_spieler, aktuelle_runde FROM `spiele`WHERE s_id = :s_id ");

		$spielArr = array
		(
				s_id => $id
		);
		
        $stmt->execute($spielArr);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
	
	public function persistiereSpieler()
	{

        global $dbh;

        $stmt = $dbh->prepare("UPDATE spiele SET derzeitiger_spieler = :spieler WHERE s_id = :s_id");
		
		$spielArr = array
		(
				spieler	=> $this->getAktuellerSpieler(),
				s_id 	=> $this->getSId()[0][s_id]
		);
        print_r($spielArr);

        $stmt->execute($spielArr);

    }
	
	public function persistiereRunde()
	{

        global $dbh;

        $stmt = $dbh->prepare("UPDATE spiele SET Aktuelle_Runde = :runde WHERE s_id = :s_id");
		
		$spielArr = array
		(
				runde	=> $this->getAktuelleRunde(),
				s_id 	=> $this->getSId()[0][s_id]
		);


        $stmt->execute($spielArr);
    }
	
	public static function getSpielerAusDB($s_id)
	{

        global $dbh;

        $stmt = $dbh->prepare("SELECT id, username FROM spiele, spielkarte, user WHERE spiele.s_id = :s_id AND spiele.s_id = spielkarte.s_id AND spielkarte.u_id = user.id ");

		$spielArr = array
		(
			s_id => $s_id
		);
		
        $stmt->execute($spielArr);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

/**
 * Funktionstest
 
$spiel = new Spiel();
$spiel->spielen();

**/