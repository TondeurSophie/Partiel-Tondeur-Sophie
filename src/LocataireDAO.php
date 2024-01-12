<?php
include("Locataire.php");
include("config.php");

class LocataireDAO {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    //fonction permettant l'ajout d'un propriete dans la BDD grâce à une requete SQL
    public function ajouterLocataire(Locataire $locataires) {
        //Exception des tests unitaires
        if(is_integer($locataires->getNom())||is_integer($locataires->getPrenom())||is_integer($locataires->getDate_naissance())||is_integer($locataires->getBancaire())||is_integer($locataires->getHisto_paiment())){
            throw new InvalidArgumentException("champs invalide");
        }else if ($locataires->getNom() ==""||$locataires->getPrenom() ==""||$locataires->getDate_naissance() ==""||$locataires->getBancaire() ==""||$locataires->getHisto_paiment() ==""||is_string($locataires->getId())){
            throw new InvalidArgumentException("champs invalide");
        }
        //Ajout d'une propriete
        try {
            $requete = $this->bdd->prepare("INSERT INTO locataires (id,nom, prenom, date_naissance, bancaire, histo_paiment) VALUES (?,?,?,?,?,?)");
            $requete->execute([$locataires->getId(),$locataires->getNom(),$locataires->getPrenom(),$locataires->getDate_naissance(),$locataires->getBancaire(),$locataires->getHisto_paiment()]);
            return true;
        } catch (PDOException $e) {
            //Gestion erreur
            echo "Erreur d'ajout de locataires : " . $e->getMessage();
            return false;
        }
    }
    


    // public function modifierPropriete($id, $nouveauSurface, $nouveauNb_chambre) {
    //     //Exception des tests unitaires
    //     if(is_string($nouveauNb_chambre())||is_integer($nouveauSurface)||$nouveauSurface == ""){
    //         throw new InvalidArgumentException("ne correspond pas aux attentes");
    //     }
    //     try {
    //         $requete = $this->bdd->prepare("UPDATE proprietes SET surface = ?, nb_chambre = ? WHERE id = ?");
    //         $requete->execute([$nouveauSurface,$nouveauNb_chambre, $id]);
    //         return true;
    //     } catch (PDOException $e) {
    //         //gestion erreur
    //         echo "Erreur de modification de la propriete : " . $e->getMessage();
    //         return false;
    //     }
    // }

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
}

//Tests dans la console : 

$DAO = new LocataireDAO($connexion);

$locataire=new Locataire(3,"Rougerie", "Jean", "1976-02-24", "donnees", "sdfe");
$DAO->ajouterLocataire($locataire);

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