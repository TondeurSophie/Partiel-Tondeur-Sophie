<?php
class Locataire {
    //Variable sont en private car pas on ne les appele pas en dehors de la class 
    private $id;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $bancaire;
    private $histo_paiment;
    
   
//Constructeur avec $id,$nom, $prenom, $date_naissance, $bancaire, $histo_paiment
    public function __construct($id,$nom, $prenom, $date_naissance, $bancaire, $histo_paiment) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->bancaire = $bancaire;
        $this->histo_paiment = $histo_paiment;
    }
//Get afin d'obtenir toutes les valeurs de mes objets au fur et a mesure des besoins
//Les get permettent de recuperer des parametres particuliers dans mes objets
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getDate_naissance(){
        return $this->date_naissance;
    }
    public function getBancaire(){
        return $this->bancaire;
    }
    public function getHisto_paiment(){
        return $this->histo_paiment;
    }
    

}
?>