<?php
class ContratLocation{
    //Variable sont en private car pas on ne les appele pas en dehors de la class 
    private $id;
    private $id_propriete;
    private $id_locataire;
    private $date_debut;
    private $date_fin;
    private $loyer;
    private $paiment_effectués;
    private $etat;
   
//Constructeur avec $id,$id_propriete, $id_locataire, $date_debut, $date_fin, $loyer, $paiment_effectués,$etat
    public function __construct($id,$id_propriete, $id_locataire, $date_debut, $date_fin, $loyer, $paiment_effectués,$etat) {
        $this->id = $id;
        $this->id_propriete = $id_propriete;
        $this->id_locataire = $id_locataire;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->loyer = $loyer;
        $this->paiment_effectués = $paiment_effectués;
        $this->etat = $etat;
    }
//Get afin d'obtenir toutes les valeurs de mes objets au fur et a mesure des besoins
//Les get permettent de recuperer des parametres particuliers dans mes objets
    public function getId() {
        return $this->id;
    }

    public function getId_propriete() {
        return $this->id_propriete;
    }

    public function getId_locataire(){
        return $this->id_locataire;
    }

    public function getDate_debut(){
        return $this->date_debut;
    }
    public function getDate_fin(){
        return $this->date_fin;
    }
    public function getLoyer(){
        return $this->loyer;
    }
    public function getPaiment_effectués(){
        return $this->paiment_effectués;
    }

    public function getEtat(){
        return $this->etat;
    }
}
?>