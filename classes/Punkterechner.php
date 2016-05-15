<?php

/**
 * Helferklasse zur Punkteberechnung
 * Bietet für jedes Feld eine statische Methode, um die Punkte für das übergebene Würfelbild zu ermitteln.
 *
 * Created by PhpStorm.
 * User: anwender
 * Date: 15.05.2016
 * Time: 18:49
 */
class Punkterechner
{
    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Einsen
     */
    public static function getEinerPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 1) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Zweien
     */
    public static function getZweierPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 2) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Dreien
     */
    public static function getDreierPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 3) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Vieren
     */
    public static function getViererPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 4) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Fünfen
     */
    public static function getFuenferPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 5) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Sechsen
     */
    public static function getSechserPunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            if ($wuerfel[$i]->getWert() == 6) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Punkte, wenn ein Dreierpasch vorliegt
     */
    public static function getDreierpaschPunkte($wuerfel)
    {
        $summe = 0;
        if (self::hatDreierpasch($wuerfel)) {
            for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild ein Dreierpasch vorliegt
     */
    private static function hatDreierpasch($wuerfel)
    {
        for ($i = 1; $i <= Wuerfel::MAXAUGENZAHL; $i = $i + 1) {
            $counter = 0;
            for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
                if ($wuerfel[$j]->getWert() == $i) {
                    $counter = $counter + 1;
                }
            }
            if ($counter >= 3) {
                return true;
            }
        }
        return false;
    }

    /*
     * Gesamtsumme aller im Würfelbild enthaltenen Punkte, wenn ein Viererpasch vorliegt
     */
    public static function getViererpaschPunkte($wuerfel)
    {
        $summe = 0;
        if (self::hatViererpasch($wuerfel)) {
            for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
                $summe = $summe + $wuerfel[$i]->getWert();
            }
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild ein Viererpasch vorliegt
     */
    private static function hatViererpasch($wuerfel)
    {
        for ($i = 1; $i <= Wuerfel::MAXAUGENZAHL; $i = $i + 1) {
            $counter = 0;
            for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
                if ($wuerfel[$j]->getWert() == $i) {
                    $counter = $counter + 1;
                }
            }
            if ($counter >= 4) {
                return true;
            }
        }
        return false;
    }

    /*
     * 25 Punkte, wenn ein FullHouse vorliegt
     */
    public static function getFullHousePunkte($wuerfel)
    {

        $summe = 0;
        if (self::hatFullHouse($wuerfel)) {
            $summe = 25;
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild ein Full House vorliegt
     */
    private static function hatFullHouse($wuerfel)
    {
        $hatZweier = false;
        $hatDreier = false;

        for ($i = 1; $i <= Wuerfel::MAXAUGENZAHL; $i = $i + 1) {
            $counter = 0;
            for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
                if ($wuerfel[$j]->getWert() == $i) {
                    $counter = $counter + 1;
                }
            }
            if ($counter == 2) {
                $hatZweier = true;
            }
            if ($counter == 3) {
                $hatDreier = true;
            }
        }

        if ($hatZweier && $hatDreier) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 30 Punkte, wenn eine kleine Straße vorliegt
     */
    public static function getKleineStrassePunkte($wuerfel)
    {

        $summe = 0;
        if (self::hatKleineStrasse($wuerfel)) {
            $summe = 30;
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild eine kleine Straße vorliegt
     */
    private static function hatkleineStrasse($wuerfel)
    {
        $eins = false;
        $zwei = false;
        $drei = false;
        $vier = false;
        $fuenf = false;
        $sechs = false;

        //zu basteln
        for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
            switch ($wuerfel[$j]->getWert()) {
                case 1:
                    $eins = true;
                    break;
                case 2:
                    $zwei = true;
                    break;
                case 3:
                    $drei = true;
                    break;
                case 4:
                    $vier = true;
                    break;
                case 5:
                    $fuenf = true;
                    break;
                case 6:
                    $sechs = true;
                    break;
            }
        }

        //Es gibt genau drei Möglichkeiten eine kleine Straße zu haben!
        if (($eins & $zwei & $drei & $vier) | ($zwei & $drei & $vier & $fuenf) | ($drei & $vier & $fuenf & $sechs)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 40 Punkte, wenn eine große Straße vorliegt
     */
    public static function getGrosseStrassePunkte($wuerfel)
    {

        $summe = 0;
        if (self::hatGroßeStrasse($wuerfel)) {
            $summe = 40;
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild eine große Straße vorliegt
     */
    private static function hatGroßeStrasse($wuerfel)
    {
        $eins = false;
        $zwei = false;
        $drei = false;
        $vier = false;
        $fuenf = false;
        $sechs = false;

        //zu basteln
        for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
            switch ($wuerfel[$j]->getWert()) {
                case 1:
                    $eins = true;
                    break;
                case 2:
                    $zwei = true;
                    break;
                case 3:
                    $drei = true;
                    break;
                case 4:
                    $vier = true;
                    break;
                case 5:
                    $fuenf = true;
                    break;
                case 6:
                    $sechs = true;
                    break;
            }
        }

        //Es gibt genau zwei Möglichkeiten eine große Straße zu haben.
        if (($eins & $zwei & $drei & $vier & $fuenf) | ($zwei & $drei & $vier & $fuenf & $sechs)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 50 Punkte, wenn ein Kniffel vorliegt
     */
    public static function getKniffelPunkte($wuerfel)
    {

        $summe = 0;
        if (self::hatKniffel($wuerfel)) {
            $summe = 50;
        }
        return $summe;
    }

    /*
     * Prüfe ob im Würfelbild ein Kniffel vorliegt
     */
    private static function hatKniffel($wuerfel)
    {
        for ($i = 1; $i <= Wuerfel::MAXAUGENZAHL; $i = $i + 1) {
            $counter = 0;
            for ($j = 1; $j <= WuerfelSpiel::ANZAHLWUERFEL; $j = $j + 1) {
                if ($wuerfel[$j]->getWert() == $i) {
                    $counter = $counter + 1;
                }
            }
            if ($counter == WuerfelSpiel::ANZAHLWUERFEL) {
                return true;
            }
        }
        return false;
    }

    /*
     * Summe aller Augen, egal welches Bild
     */
    public static function getChancePunkte($wuerfel)
    {
        $summe = 0;
        for ($i = 1; $i <= WuerfelSpiel::ANZAHLWUERFEL; $i = $i + 1) {
            $summe = $summe + $wuerfel[$i]->getWert();
        }
        return $summe;
    }


}