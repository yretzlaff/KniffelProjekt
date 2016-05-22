<?php

/**
 * Ein Spieler hat eine eigene Spielkarte, auf der die Punkte gespeichert werden und einen Namen zur Unterscheidung
 */
class Spieler
{
    private $name;
    private $spielkarte;
    private $id;

    /*
     * Konstruktor der Klasse Spieler
     */
    public function __construct($id, $name)
    {
        require_once("Spielkarte.php");
        $this->name = $name;
        $this->id = $id;
        $this->spielkarte = new Spielkarte();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
	    return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Spielkarte
     */
    public function getSpielkarte()
    {
        return $this->spielkarte;
    }

    /**
     * @param Spielkarte $spielkarte
     */
    public function setSpielkarte($spielkarte)
    {
        $this->spielkarte = $spielkarte;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    


}