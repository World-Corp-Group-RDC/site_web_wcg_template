<?php
class Rubrique{
    // Connexion
    // private $connexion;
    // private $table = "Rubrique";

    // // object properties
    // public $id;
    // public $nom;
    // public $description;
    // public $prix;
    // public $categories_id;
    // public $categories_nom;
    // public $created_at;

    // /**
    //  * Constructeur avec $db pour la connexion à la base de données
    //  *
    //  * @param $db
    //  */
    // public function __construct($db){
    //     $this->connexion = $db;
    // }

    // /**
    //  * Lecture des Rubrique
    //  *
    //  * @return void
    //  */
    // public function lire(){
    //     // On écrit la requête
    //     $sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id ORDER BY p.created_at DESC";

    //     // On prépare la requête
    //     $query = $this->connexion->prepare($sql);

    //     // On exécute la requête
    //     $query->execute();

    //     // On retourne le résultat
    //     return $query;
    // }
  

}