<?php

class Manager
{
	//se connecte a la base de donnee
	protected function dbConnect()
	{
	    $db = new \PDO('mysql:host=localhost;dbname=blog_jf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    return $db;
	}	
}