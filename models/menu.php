<?php
class Menu{
    // Connexion
    private $connexion;

    // object properties
    public $backgroundColor;
    public $url;
    public $fontSize;
    public $name;
    public $categories_nom;


    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }


 
  

}