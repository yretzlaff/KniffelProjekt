<?php

/**
 * Ein SPieler hat eine eigene Spielkarte, auf der die Punkte gespeichert werden und testweise einen Namen zur Unterscheidung
 * User: Hendrik
 * Date: 15.05.2016
 * Time: 18:13
 */
class Spieler
{
    private $name;
    private $spielkarte;
    private $id;

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