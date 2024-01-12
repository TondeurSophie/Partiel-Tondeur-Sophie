<?php

use PHPUnit\Framework\TestCase;


require_once ("./src/LocataireDAO.php");

class LocataireDAOTest extends TestCase{
    private $pdo;
    private $locataire;

    //pour connection a la BDD
    protected function setUp(): void{
        $this->configureBDD();
        $this->locataire = new LocataireDAO($this->pdo);
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
    public function testLocataires($fonction,$expected,$id,$nom, $prenom, $date_naissance, $bancaire, $histo_paiment){

        // test pour ajouter propriete
        if($fonction == "ajouter"){
            //création objet
            $locataires=new Locataire($id,$nom, $prenom, $date_naissance, $bancaire, $histo_paiment);
            //Exception des tests unitaires
            if(is_integer($nom)||is_integer($prenom)||is_integer($date_naissance)||is_integer($bancaire)||is_integer($histo_paiment)){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("champs invalide");
                throw new InvalidArgumentException("champs invalide");
            }else if ($nom ==""||$prenom ==""||$date_naissance ==""||$bancaire ==""||$histo_paiment ==""||is_string($id)){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage("champs invalide");
                throw new InvalidArgumentException("champs invalide");
            }
        
            //tests d'ajout
            $this->locataire->ajouterLocataire($locataires);
            $stmt = $this->pdo->prepare("SELECT * FROM locataires WHERE nom = :nom");
            $stmt->bindParam(":nom",$nom);
            $locataires=$stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($locataires);
            $this->assertEquals($expected,$nom);
        }
        
    }

    public static function Provider(){
        return[
            //tableau :
            //$fonction,$expected,$id,$nom, $prenom, $date_naissance, $bancaire, $histo_paiment

            ["ajouter","Rousseau",4,"Rousseau", "Paul", "1956-08-09", "bancaire", "dfg"],
            ["ajouter","","","", "", "", "", ""],
            ["ajouter","Rousseau","4","Rousseau", "Paul", "1956-08-09", "bancaire", "dfg"],
            
            
        ];
    }


}


?>