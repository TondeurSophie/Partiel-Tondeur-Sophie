<?php
require_once ("./src/ProprieteDAO.php");

$choix =readline("Que voulez-vous faire ? \n 1. Lister les proprietes \n 2. Choisir une propriete\n 3.Afficher les détails d'une propriete");
switch($choix){
    case 1:
        $DAO = new ProprieteDAO($connexion);
        $propriete = $DAO->listerPropriete();

        if ($propriete){
            foreach($propriete as $e){
                echo "Id : ".$e['id']."\n";
                echo 'adresse : '.$e['adresse']."\n";
                echo "_ _ _ _ _ _ _ _ _ _ _ _ _ _\n";
                
            }
        }
        break;

    case 2:
        $DAO = new ProprieteDAO($connexion);
        $propriete = $DAO->listerPropriete();

        if ($propriete){
            foreach($propriete as $e){
                echo "Id : ".$e['id']."\n";
                echo 'adresse : '.$e['adresse']."\n";
                echo 'locataires : '.$e['locataire']."\n";
                echo 'prix location: '.$e['prix_location']."\n";
                echo "_ _ _ _ _ _ _ _ _ _ _ _ _ _\n";
                
            }
        }

        $choix_location = readline("Quelle location voulez-vous (id)? \n");
        $propriete =$DAO->modifierPropriete($choix_location,"","","nouveauLocataire");
        break;

    case 3:
        $DAO = new ProprieteDAO($connexion);
        $propriete = $DAO->listerPropriete();
        
        if ($propriete){
            foreach($propriete as $e){
                echo "Id : ".$e['id']."\n";
                echo 'adresse : '.$e['adresse']."\n";
                echo "_ _ _ _ _ _ _ _ _ _ _ _ _ _\n";
                
            }
        }
        
        $choix_propriete = readline("Quelle propriete voulez-vous voir en détails ?\n");
        // $propriete = $DAO->trouverProprieteParId($choix_propriete);

        break;
}


?>