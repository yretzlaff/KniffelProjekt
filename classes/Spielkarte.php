<?php

/**
 * Speichert die Punkte für jedes Feld, welche durch einen Spieler erziehlt wurden.
 * Den setter-Methoden wird eine Array mit Würfeln übergeben.
 * Aus den Würfeln wird mithilfe der Klasse Punkterechner die Punktzahl für dieses Feld errechnet, 
 * die dann im entsprechenden Attribut gespeichert wird.
 *
 * User: Hendrik
 * Date: 15.05.2016
 * Time: 18:14
 */
class Spielkarte
{
    private $einer;
    private $zweier;
    private $dreier;
    private $vierer;
    private $fuenfer;
    private $sechser;
    private $dreierpasch;
    private $viererpasch;
    private $full_house;
    private $kleine_strasse;
    private $grosse_strasse;
    private $kniffel;
    private $chance;

    public function getEiner()
    {
        return $this->einer;
    }

    public function setEiner($wuerfel)
    {
            $this->einer = Punkterechner::getEinerPunkte($wuerfel);
    }
    
    public function isSetEiner(){
        if($this->einer !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getZweier()
    {
        return $this->zweier;
    }

    public function setZweier($wuerfel)
    {
        $this->zweier = Punkterechner::getZweierPunkte($wuerfel);
    }

    public function isSetZweier(){
        if($this->zweier !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getDreier()
    {
        return $this->dreier;
    }

    public function setDreier($wuerfel)
    {
        $this->dreier = Punkterechner::getDreierPunkte($wuerfel);
    }

    public function isSetDreier(){
        if($this->dreier !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }
    
    public function getVierer()
    {
        return $this->vierer;
    }

    function setVierer($wuerfel)
    {
        $this->vierer = Punkterechner::getViererPunkte($wuerfel);
    }

    public function isSetVierer(){
        if($this->vierer !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getFuenfer()
    {
        return $this->fuenfer;
    }

    public function setFuenfer($wuerfel)
    {
        $this->fuenfer = Punkterechner::getFuenferPunkte($wuerfel);
    }

    public function isSetFuenfer(){
        if($this->fuenfer !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getSechser()
    {
        return $this->sechser;
    }

    public function setSechser($wuerfel)
    {
        $this->sechser = Punkterechner::getSechserPunkte($wuerfel);
    }

    public function isSetSechser(){
        if($this->sechser !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getDreierpasch()
    {
        return $this->dreierpasch;
    }

    public function setDreierpasch($wuerfel)
    {
        $this->dreierpasch = Punkterechner::getDreierpaschPunkte($wuerfel);
    }

    public function isSetDreierpasch(){
        if($this->dreierpasch !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getViererpasch()
    {
        return $this->viererpasch;
    }

    public function setViererpasch($wuerfel)
    {
        $this->viererpasch = Punkterechner::getViererpaschPunkte($wuerfel);
    }

    public function isSetViererpasch(){
        if($this->viererpasch !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getFullHouse()
    {
        return $this->full_house;
    }

    public function setFullHouse($wuerfel)
    {
        $this->full_house = Punkterechner::getFullHousePunkte($wuerfel);
    }

    public function isSetFullHouse(){
        if($this->full_house !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getKleineStrasse()
    {
        return $this->kleine_strasse;
    }

    public function setKleineStrasse($wuerfel)
    {
        $this->kleine_strasse = Punkterechner::getKleineStrassePunkte($wuerfel);
    }

    public function isSetKleineStrasse(){
        if($this->kleine_strasse !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getGrosseStrasse()
    {
        return $this->grosse_strasse;
    }

    public function setGrosseStrasse($wuerfel)
    {
        $this->grosse_strasse = Punkterechner::getGrosseStrassePunkte($wuerfel);
    }

    public function isSetGrosseStrasse(){
        if($this->grosse_strasse !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getKniffel()
    {
        return $this->kniffel;
    }

    public function setKniffel($wuerfel)
    {
        $this->kniffel = Punkterechner::getKniffelPunkte($wuerfel);
    }

    public function isSetKniffel(){
        if($this->kniffel !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    public function getChance()
    {
        return $this->chance;
    }

    public function setChance($wuerfel)
    {
        $this->chance = Punkterechner::getChancePunkte($wuerfel);
    }

    public function isSetChance(){
        if($this->chance !== null){
            return "disabled";
        }
        else{
            return "";
        }
    }

    /*
     * Gebe die Summme der oberen sechs Einzelfelder zurück
     */
    public function getSummeOben()  {
        return ($this->einer + $this->zweier + $this->dreier + $this->vierer + $this->fuenfer + $this->sechser);
    }

    /*
     * Gibt die Bonuspunkte zurück, die ein SPieler aufgrund der oberen Punkte (nicht) erhält
     */
    public function getBonusOben()  {
        if ($this->getSummeOben() >= 63)    {
            return 35;
        }
        else    {
            return 0;
        }
    }

    /*
     * Gibt die obere Gesamtsumme (Obere Zahlen + Bonuspunkte) zurück
     */
    public function getGesamtOben()     {
        return ($this->getSummeOben() + $this->getBonusOben());
    }

    /*
     * Gibt die untere Gesamtsumme der Sonderwürfe zurück
     */
    public function getGesamtUnten()    {
        return ($this->dreierpasch + $this->viererpasch + $this->full_house + $this->kleine_strasse + $this->große_strasse + $this->kniffel + $this->chance);
    }

    /*
     * Gibt die Summe aller Punkte (oben + unten) zurück
     */
    public function getGesamtSumme()    {
        return ($this->getGesamtOben() + $this->getGesamtUnten());
    }


}