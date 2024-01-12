<?php
include("Propriete.php");
include("config.php");

class ProprieteDAO {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    //fonction permettant l'ajout d'un propriete dans la BDD grâce à une requete SQL
    public function ajouterPropriete(Propriete $proprietes) {
        //Exception des tests unitaires
        if(is_integer($proprietes->getAdresse()) ||is_integer($proprietes->getType()) ||is_integer($proprietes->getSurface())||is_string($proprietes->getNb_chambre()) ||is_integer($proprietes->getPrix_location())||is_integer($proprietes->getEtat())){
            throw new InvalidArgumentException("champs invalide");
        }
        else if($proprietes->getAdresse() == "" ||$proprietes->getType() == "" ||$proprietes->getSurface() == "" ||$proprietes->getPrix_location() == "" ||$proprietes->getEtat() == "" ||is_string($proprietes->getId())){
            throw new InvalidArgumentException("champs invalide");
        }
        //Ajout d'une propriete
        try {
            $requete = $this->bdd->prepare("INSERT INTO proprietes (id,adresse, type, surface, nb_chambre, prix_location, etat,locataire) VALUES (?,?,?,?,?,?,?,?)");
            $requete->execute([$proprietes->getId(),$proprietes->getAdresse(),$proprietes->getType(),$proprietes->getSurface(),$proprietes->getNb_chambre(),$proprietes->getPrix_location(),$proprietes->getEtat(),$proprietes->getLocataire()]);
            return true;
        } catch (PDOException $e) {
            //Gestion erreur
            echo "Erreur d'ajout de proprietes : " . $e->getMessage();
            return false;
        }
    }
    


    public function modifierPropriete($id, $nouveauSurface, $nouveauNb_chambre, $nouveauLocataire) {
        //Exception des tests unitaires
        if(is_string($nouveauNb_chambre())||is_integer($nouveauSurface)||$nouveauSurface == ""){
            throw new InvalidArgumentException("ne correspond pas aux attentes");
        }
        try {
            $requete = $this->bdd->prepare("UPDATE proprietes SET surface = ?, nb_chambre = ?, locataire = ? WHERE id = ?");
            $requete->execute([$nouveauSurface,$nouveauNb_chambre,$nouveauLocataire, $id]);
            return true;
        } catch (PDOException $e) {
            //gestion erreur
            echo "Erreur de modification de la propriete : " . $e->getMessage();
            return false;
        }
    }

    public function listerPropriete() {
        //Liste des categories en selectionnant toute la table
        try {
            $requete = $this->bdd->prepare("SELECT * FROM proprietes");
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur de recuperation des proprietes: " . $e->getMessage();
            return [];
        }
    }

    // 

    // public function trouverProprieteParId($id) {
    //     if($id == "" || is_string($id)){
    //         throw new InvalidArgumentException("Id invalide");
    //     }
    //     try {
    //         //Recherche un personnage en particulier en fonction de l'id
    //         $requete = $this->bdd->prepare("SELECT * FROM proprietes WHERE id = ?");
    //         $requete->execute([$id]);
    //         $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    //         if ($resultat) {
    //             return new Propriete($resultat['id']);
    //         } else {
    //             return null;
    //         }
    //     } catch (PDOException $e) {
    //         echo "Erreur lors de la recherche de la propriete par ID: " . $e->getMessage();
    //         return null;
    //     }
    // }

}

//Tests dans la console : 

$DAO = new ProprieteDAO($connexion);

// $propriete=new Propriete(5,"5 rue Henry Prout","Appartement","35m2",3,"150","libre","");
// $DAO->ajouterPropriete($propriete);

// $propriete=$DAO->modifierPropriete(4,"test",5);

// $propriete = $DAO->listerPropriete();

// if ($propriete){
//     foreach($propriete as $e){
//         echo "Id : ".$e['id']."\n";
//         echo 'adresse : '.$e['adresse']."\n";
//         echo "_ _ _ _ _ _ _ _ _ _ _ _ _ _\n";
//     }
// }

?>