<?php

//namespace OpenClassrooms\Blog\Model; // La classe sera dans ce namespace

require_once("../src/model/Manager.php"); // Vous n'alliez pas oublier cette ligne ? ;o)

class PostManager extends Manager
{
	//Recupere les 5 dernier post
	public function getRecentPosts()
	{
		$db = $this->dbConnect();

		// On récupère les 5 derniers billets
		$req = $db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');

		return $req;
	}

	//recupere 1 post 
	public function getPost($postId)
	{
	    $db = $this->dbConnect();

	    $req = $db->prepare('SELECT id, author, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}
}