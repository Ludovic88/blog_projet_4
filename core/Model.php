<?php 
require("Database.php");

/**
 * Class Model
 * Model principal
 * Gere les functions appeller dans les enfants
 */
class Model 
{
	protected $db;
    //private $_singleton = Database::getInstance();
    function __construct(){
		$this->db = Database::getInstance()->dbConnect();
    }
}