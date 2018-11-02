<?php
/**
 * Class Database
 * Singleton qui gere la conection a la base de donnée
 */
class Database  
{
    private static $_instance = null;
    private $_db;
    
    /**
     * Constructeur
     * Se connecte a la base de donée
     * La Stock dans la variable $db
     */
    private function __construct()
    {
        $this->_db = new \PDO('mysql:host=localhost;dbname=blog_jf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    /**
     * Verifie si la conection est deja établie
     * Si non l'etablir
     * Si oui ne rien faire
     */
    public static function getInstance()
    {
        if (self::$_instance == null)
        {
      		self::$_instance = new Database();
        }
        return self::$_instance;
    }

    /**
     * Renvoie la $variable qui contient la bdd
     */
    public function dbConnect()
    {
        return $this->_db;
    }
}