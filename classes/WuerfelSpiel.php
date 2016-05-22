<?php

/**
 * Die Klasse Wuerfelspiel managed einen Spielzug mit 3 Wurfversuchen.
 * Dabei können Würfel zwischen Bank und Becher hin und her getauscht werden.
 *
 * User: Hendrik
 * Date: 15.05.2016
 * Time: 14:17
 */
class WuerfelSpiel
{
    const ANZAHLWUERFEL = 5;
    const ANZAHLVERSUCHE = 3;

    private $becher;
    private $bank;
    private $geworfen;

    /*
     * Konstruktor zur erzeugung eines Würfelspiels
     */
    public function __construct()
    {
        require_once("Wuerfel.php");
        $this->becher = array(1 => new Wuerfel(),
            2 => new Wuerfel(),
            3 => new Wuerfel(),
            4 => new Wuerfel(),
            5 => new Wuerfel(),
        );

        $this->bank = array(1 => null,
            2 => null,
            3 => null,
            4 => null,
            5 => null,
            );
        $this->geworfen = 0;
    }

    /*
     * Bewege den Würfel mit der übergebenen Nummer $wuerfelnr aus dem Becher auf die Bank
     */
    public function moveToBank($wuerfelnr)
    {
        if (isset($this->becher[$wuerfelnr])) {
            echo("<br />\n");
            echo("<br />\nSetze Würfel " . $wuerfelnr . " auf die Bank!");
            $this->bank[$wuerfelnr] = $this->becher[$wuerfelnr];
            $this->becher[$wuerfelnr] = null;
        }
    }

    /*
     * Bewege den Würfel mit der übergebenen Nummer $wuerfelnr von der Bank zurück in den Becher
     */
    public function moveToBecher($wuerfelnr)
    {
        if (isset($this->bank[$wuerfelnr])) {
            echo("<br />\n");
            echo("<br />\nSetze Würfel " . $wuerfelnr . " in den Becher!");
            $this->becher[$wuerfelnr] = $this->bank[$wuerfelnr];
            $this->bank[$wuerfelnr] = null;
        }
    }

    /*
     * Wenn der Spieler nochmal würfeln darf, werden für Würfel, die nicht auf der Bank liegen neue Zufallswerte ermittelt.
     */
    public function wuerfeln()
    {
        if ($this->darfwuerfeln()) {
            echo("<br />\n ");
            echo("<br />\n Neu Würfeln!");

            for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
                if (isset($this->becher[$i])) {
                    $this->becher[$i]->wuerfeln();
                }
            }
            $this->geworfen = $this->geworfen + 1;
        }
    }

    /*
     * Prüft, ob die Maximale Anzahl der Würfelversuche nicht überschritten wurde
     */
    public function darfwuerfeln()
    {
        if ($this->geworfen < WuerfelSpiel::ANZAHLVERSUCHE) {
            //Darf nochmal würfeln
            return true;
        } else {
            //Maximale Wurfzahl erreicht
            return false;
        }
    }

    /*
     * Prüft, ob der Spieler schon seinen ersten Startwurf gemacht hat
     */
    public function hatgewürfelt(){
        if ($this->geworfen == 0)   {
            //Spieler hat noch nicht gewürfelt
            return false;
        }
        else    {
            //Spieler hat schon mindestens einmal gewürfelt
            return true;
        }
    }

    /*
     * Gibt die Würfel von der Bank als Array zurück
     */
    public function getBank()
    {
        return $this->bank;
    }

    /*
     * Gibt die Würfel im Becher als Array zurück
     */
    public function getBecher()
    {
        return $this->becher;
    }

    /*
     * Gibt alle Würfel aus Becher und Bank als Array zurück
     */
    public function getWuerfel()
    {
        $w = $this->getBecher();

        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if (!isset($w[$i]) && isset($this->getBank()[$i])) {
                $w[$i] = $this->getBank()[$i];
            }
        }

        return $w;
    }

    /**
     * @return int
     */
    public function getGeworfen()
    {
        return $this->geworfen;
    }
    
    

    /*
     * Ausgabe der Würfel auf der Bank zu Testzwecken
     */
    public function printBank()
    {
        echo("<br />\n ");

        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if (isset($this->getBank()[$i])) {
                echo("<br />\n Bank " . $i . ": " . $this->getBank()[$i]->getWert());
            } else {
                echo("<br />\n Bank " . $i . ": ");
            }
        }
    }

    /*
     * Ausgabe der Würfel im Becher zu Testzwecken
     */
    public function printBecher()
    {
        echo("<br />\n ");

        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if (isset($this->getBecher()[$i])) {
                echo("<br />\n Becher " . $i . ": " . $this->getBecher()[$i]->getWert());
            } else {
                echo("<br />\n Becher " . $i . ": ");
            }
        }
    }

}

/*
 * Kleine Funktionstests zu Simulationszwecken
 */

/*
$spiel = new WuerfelSpiel();
$spiel->printBecher();  //Würfelbecher ohne Würfel
$spiel->wuerfeln();     //Erster Wurf
$spiel->printBecher();
$spiel->wuerfeln();     //Zweiter Wurf
$spiel->printBecher();
$spiel->wuerfeln();     //Dritter Wurf
$spiel->printBecher();
$spiel->wuerfeln();     //Versuch eines vierten Wurfs
$spiel->printBecher();
*/
