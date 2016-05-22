<?php

/**
 * Speichert die Punkte für jedes Feld, welche durch einen Spieler erziehlt wurden.
 * Den setter-Methoden wird eine Array mit Würfeln übergeben.
 * Aus den Würfeln wird mithilfe der Klasse Punkterechner die Punktzahl für dieses Feld errechnet, 
 * die dann im entsprechenden Attribut gespeichert wird.
 *
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

    private $sk_id;

    public function getEiner()
    {
        return $this->einer;
    }

    public function setEiner($wuerfel)
    {
            $this->einer = Punkterechner::getEinerPunkte($wuerfel);

        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Einer`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getEinerPunkte($wuerfel),
            sk_id => $this->sk_id
        );

        $stmt->execute($daten);


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

        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Zweier`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getZweierPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);
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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Dreier`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getDreierPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Vierer`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getViererPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);
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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Fuenfer`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getFuenferPunkte($wuerfel),
            sk_id => $this->sk_id
        );


        $stmt->execute($daten);
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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Sechser`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getSechserPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);
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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Dreierpasch`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getDreierpaschPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Viererpasch`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getViererpaschPunkte($wuerfel),
            sk_id => $this->sk_id
        );

    

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Full_House`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getFullHousePunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `kleine_Strasse`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getKleineStrassePunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `grosse_Strasse`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getGrosseStrassePunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Kniffel`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getKniffelPunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);

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


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `Chance`= :wert WHERE sk_id = :sk_id");

        $daten = array
        (
            wert => Punkterechner::getChancePunkte($wuerfel),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($daten);
    }
    //Überprüft ob der Wert gesetzt ist, um die entsprechenden Buttons zu disablen
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
        return ($this->dreierpasch + $this->viererpasch + $this->full_house + $this->kleine_strasse + $this->grosse_strasse + $this->kniffel + $this->chance);
    }

    /*
     * Gibt die Summe aller Punkte (oben + unten) zurück
     */
    public function getGesamtSumme()    {
        return ($this->getGesamtOben() + $this->getGesamtUnten());
    }

    public function getSkId()
    {
        return $this->sk_id;
    }

    public function setSkId($sk_id)
    {
        $this->sk_id = $sk_id;
    }


    public static function persistiereSpielkarte($u_id, $s_id, $position){

        global $dbh;

        $stmt = $dbh->prepare("INSERT INTO `spielkarte`(`u_id`, `s_id`, `Position`) VALUES (:user, :spiel, :pos)");

        $kartendaten = array
        (
            user => $u_id,
            spiel => $s_id,
            pos => $position
        );

        $stmt->execute($kartendaten);
    }

    /*
     * Liefert die zuletzt gespeicherte Spielkarte aus der DB
     */
    public static function getLetzteSpielkarteinDB(){

        global $dbh;

        $stmt = $dbh->prepare("SELECT sk_id FROM `spielkarte` ORDER BY sk_id DESC LIMIT 1 ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function persistiereSummeOben(){


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `summe_oben`= :summeOben WHERE sk_id = :sk_id");

        $kartendaten = array
        (
            summeOben => $this->getGesamtOben(),
            sk_id => $this->sk_id
        );

        $stmt->execute($kartendaten);


    }

    public function persistiereSummeUnten(){


        global $dbh;

        $stmt = $dbh->prepare("UPDATE `spielkarte` SET `summe_unten`= :summeUnten WHERE sk_id = :sk_id");


        $kartendaten = array
        (
            summeUnten => $this->getGesamtUnten(),
            sk_id => $this->sk_id
        );
        

        $stmt->execute($kartendaten);


    }

    /*
     * Hier wird eine persistierte Spielkarte aus der Datenbank gelesen und in das Objekt übertragen
     */
    public function fetchSpielkarte($u_id, $s_id){

        global $dbh;

        $stmt = $dbh->prepare("SELECT * FROM `spielkarte`WHERE s_id = :s_id AND u_id = :u_id");

        $spielArr = array
        (
            s_id => $s_id,
            u_id => $u_id
        );

        $stmt->execute($spielArr);

        $geladenenDaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
		$this->sk_id = $geladenenDaten[0][sk_id];
        $this->einer = $geladenenDaten[0][Einer];
        $this->zweier = $geladenenDaten[0][Zweier];
        $this->dreier = $geladenenDaten[0][Dreier];
        $this->vierer = $geladenenDaten[0][Vierer];
        $this->fuenfer = $geladenenDaten[0][Fuenfer];
        $this->sechser = $geladenenDaten[0][Sechser];

        $this->dreierpasch = $geladenenDaten[0][Dreierpasch];
        $this->viererpasch = $geladenenDaten[0][Viererpasch];
        $this->full_house = $geladenenDaten[0][Full_House];
        $this->kleine_strasse = $geladenenDaten[0][kleine_Strasse];
        $this->grosse_strasse = $geladenenDaten[0][grosse_Strasse];
        $this->kniffel = $geladenenDaten[0][Kniffel];
        $this->chance = $geladenenDaten[0][Chance];

    }


}