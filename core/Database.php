<?php //conection db

class Database 
{
	//se connecte a la base de donnee
	public function dbConnect()
	{
	    $db = new PDO('mysql:host=localhost;dbname=blog_jf;charset=utf8', 'root', '');
	    return $db;
	}	
}