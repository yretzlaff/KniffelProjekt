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

    /*
     * Konstrukor zur instanziierung eines Spiel-Objektes
     */
    public function __construct()
    {
        //Require_Once zum Laden der Klassen in den Ausführungskontext. Warum auch immer verstehe ich nicht, aber ohne funktioniert es nicht
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
        $this->aktuellerSpieler = $this->aktuellerSpieler + 1;
        if ($this->aktuellerSpieler > count($this->spieler)) {
            $this->aktuellerSpieler = 1;
            $this->naechsteRunde();
        }
        $this->wuerfelspiel = new WuerfelSpiel();
    }

    /*
     * Wechsel in die nächste Runde. Sind alle runden gespielt rufe spielBeenden() auf.
     */
    public function naechsteRunde()
    {
        $this->aktuelleRunde = $this->aktuelleRunde + 1;
        if ($this->aktuelleRunde > Spiel::MAXANZAHLRUNDEN) {
            $this->spielBeenden();
        }
    }

    /*
     * Methode um das Spiel zu beenden
     */
    public function spielBeenden()
    {

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

        $stmt->execute(array(':spiel' => $spiel));

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSpielListe()
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT spiele.s_id, Startdatum, COUNT(sk_id) AS anz FROM `spiele` LEFT JOIN `spielkarte` ON spiele.s_id = spielkarte.s_id WHERE spiele.beendet IS NULL");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAktuellerSpieler()
    {
        return $this->aktuellerSpieler;
    }

    public function getWuerfelspiel()
    {
        return $this->wuerfelspiel;
    }

}

/**
 * Funktionstest
 
$spiel = new Spiel();
$spiel->spielen();

**/