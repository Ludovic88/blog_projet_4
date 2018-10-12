<?php 
//model principal

require("Database.php");
//recupere le singleton 
class Model 
{
    //private $_singleton = Database::getInstance();
    protected function connect(){
		$db = Database::getInstance()->dbConnect();
		return $db;
    }
}