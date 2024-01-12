<?php

use PHPUnit\Framework\TestCase;


require_once ("./src/ProprieteDAO.php");

class ProprieteDAOTest extends TestCase{
    private $pdo;
    private $propriete;

    //pour connection a la BDD
    protected function setUp(): void{
        $this->configureBDD();
        $this->propriete = new ProprieteDAO($this->pdo);
    }

    private function configureBDD(): void{
        $this->pdo = new PDO(
            sprintf(
                'mysql:host=%s;port=%s;dbname=%s',
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('DB_DATABASE')
            ),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    
    /**
     * @dataProvider Provider
     */
    public function testProprietes($fonction,$expected,$id,$adresse, $type, $surface, $nb_chambre, $prix_location, $etat,$locataire){

        // test pour ajouter propriete
        if($fonction == "ajouter"){
            //création objet
            $proprietes=new Propriete($id,$adresse, $type, $surface, $nb_chambre, $prix_location, $etat,$locataire);
            //Exception des tests unitaires
            if(is_integer($adresse) ||is_integer($type) ||is_integer($surface)||is_string($nb_chambre) ||is_integer($prix_location)||is_integer($etat)){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("champs invalide");
                throw new InvalidArgumentException("champs invalide");
            }
            else if($adresse == "" ||$type == "" ||$surface == "" ||$prix_location == "" ||$etat == ""||is_string($id) ){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("champs invalide");
                throw new InvalidArgumentException("champs invalide");
            }

            //tests d'ajout
            $this->propriete->ajouterPropriete($proprietes);
            $stmt = $this->pdo->prepare("SELECT * FROM proprietes WHERE adresse = :adresse");
            $stmt->bindParam(":adresse",$adresse);
            $proprietes=$stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($proprietes);
            $this->assertEquals($expected,$adresse);
        }
        //test pour modifier propriete
        else if($fonction == "modifier"){
            //exception test unitaire
            if(is_string($nb_chambre)||is_integer($surface)||$surface == ""){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("ne correspond pas aux attentes");
            }
            //test
            $this->propriete->modifierPropriete($id, $surface, $nb_chambre,$locataire);
            $stmt=$this->pdo->prepare("SELECT * FROM proprietes WHERE id = :id");
            $stmt->bindParam(":id",$id);
            $proprietes=$stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($proprietes);
            $this->assertEquals($expected,$surface);
        }

        // if($fonction == "trouverParId"){
        //     if($id == "" || is_string($id)){
        //         $this->expectException(InvalidArgumentException::class);
        //         $this->expectExceptionMessage("Id invalide");
        //     }
        //     $propriete=$this->proprietes->trouverProprieteParId($id);

        //     $this->assertInstanceOf(Recette::class,$propriete);
        //     $this->assertEquals($expected,$id);
        // }
        
    }

    public static function Provider(){
        return[
            //tableau :
            //$fonction,$expected,$id,$adresse, $type, $surface, $nb_chambre, $prix_location, $etat, $locataire
            ["ajouter","","","", "", "", "", "", "",""],
            ["ajouter","1 rond point des Oillets",5,"1 rond point des Oillets", "maison", "20m2", 2, "120", "occupé",""],
            ["ajouter","",5,"", "", "", 2, "", "",""],
            ["ajouter","1 rond point des Oillets","5","1 rond point des Oillets", "maison", "20m2", "2", "120", "occupé",""],
            ["ajouter",5,5,5, "maison", 50, 2, "120", "occupé",""],
            

            ["modifier","40m",5,"", "", "40m", 1, "", "",""],
            ["modifier","","","", "", "", "", "", "",""],
            ["modifier",40,5,"", "", 40, "1", "", "",""],

            // ["trouverParId","","","","","","","","","",""],
            // ["trouverParId",1,"1","","","","","","","",""],
            // ["trouverParId","","bonjour","","","","","","","",""],
            
            
        ];
    }


}


?>