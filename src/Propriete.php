<?php
class Propriete {
    //Variable sont en private car pas on ne les appele pas en dehors de la class 
    private $id;
    private $adresse;
    private $type;
    private $surface;
    private $nb_chambre;
    private $prix_location;
    private $etat;
    private $locataire;
   
//Constructeur avec $id,$adresse, $type, $surface, $nb_chambre, $prix_location, $etat
    public function __construct($id,$adresse, $type, $surface, $nb_chambre, $prix_location, $etat,$locataire) {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->type = $type;
        $this->surface = $surface;
        $this->nb_chambre = $nb_chambre;
        $this->prix_location = $prix_location;
        $this->etat = $etat;
        $this->locataire = $locataire;
    }
//Get afin d'obtenir toutes les valeurs de mes objets au fur et a mesure des besoins
//Les get permettent de recuperer des parametres particuliers dans mes objets
    public function getId() {
        return $this->id;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getType(){
        return $this->type;
    }

    public function getSurface(){
        return $this->surface;
    }
    public function getNb_chambre(){
        return $this->nb_chambre;
    }
    public function getPrix_location(){
        return $this->prix_location;
    }
    public function getEtat(){
        return $this->etat;
    }

    public function getLocataire(){
        return $this->locataire;
    }

}
?>