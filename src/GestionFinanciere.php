<?php
class GestionFinanciere {
    //Variable sont en private car pas on ne les appele pas en dehors de la class 
    private $id;
    
    
   
//Constructeur avec $id
    public function __construct($id) {
        $this->id = $id;
        
    }
//Get afin d'obtenir toutes les valeurs de mes objets au fur et a mesure des besoins
//Les get permettent de recuperer des parametres particuliers dans mes objets
    public function getId() {
        return $this->id;
    }

    

}
?>