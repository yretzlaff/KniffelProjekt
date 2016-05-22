<?php

/**
 * Die Klasse Wuerfelspiel managed einen Spielzug mit 3 Wurfversuchen.
 * Dabei können Würfel zwischen Bank und Becher hin und her getauscht werden.
 *
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

}

