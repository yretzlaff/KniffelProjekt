<?php

/**
 * Ein Würfel beinhaltet nur einen Wert und eine Methode um einen neuen Wert zu Würfeln
 *
 */
class Wuerfel
{
    const MAXAUGENZAHL = 6;
    
    private $wert;

    /*
     * Bei Erzeugung hat ein Würfel noch keinen Wert
     */
    public function __construct()
    {
        #$this->setWert(rand(1,6));
    }
    
    public  function getWert()
    {
        return $this->wert;
    }

    public function setWert($wert)
    {
        $this->wert = $wert;
    }
    
    /*
     * Diese Methode erzeugt zufallsbasiert den Augenwert des Würfels
     */
    public function wuerfeln()  {
        $this->setWert(rand(1,Wuerfel::MAXAUGENZAHL));
    }

}