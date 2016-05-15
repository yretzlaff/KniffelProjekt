<?php

/**
 * Ein Würfel beinhaltet nur einen Wert und eine Methode um einen neuen Wert zu Würfeln
 * 
 * User: Hendrik
 * Date: 15.05.2016
 * Time: 12:48
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
    
    public function wuerfeln()  {
        $this->setWert(rand(1,Wuerfel::MAXAUGENZAHL));
    }

}