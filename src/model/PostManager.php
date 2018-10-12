<?php

require_once("../core/Model.php"); // Vous n'alliez pas oublier cette ligne ? ;o)

class PostManager extends Model
{
	//Recupere tous les posts
	public function getAllPosts()
	{
		$db = $this->connect();

		// On récupère les 5 derniers billets
		$req = $db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts');

		return $req;
	}

	//Recupere les 5 dernier post
	public function getRecentPosts()
	{
		$db = $this->connect();

		// On récupère les 5 derniers billets
		$req = $db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');

		return $req;
	}

	//recupere 1 post 
	public function getPost($postId)
	{
	    $db = $this->connect();

	    $req = $db->prepare('SELECT id, author,title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}
}