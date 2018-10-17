<?php
require_once("../core/Model.php");

/**
 * Class PostManager
 * Model qui gere les posts
 */
class PostManager extends Model
{
	/**
	 * Recupere tous les posts
	 * Retourne une variable
	 */
	public function getAllPosts()
	{
		// On récupère les  billets
		$req = $this->db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts');

		return $req;
	}

	/**
	 * Recupere les 5 derniers posts
	 * Retourne une variable
	 */
	public function getRecentPosts()
	{
		// On récupère les 5 derniers billets
		$req = $this->db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');

		return $req;
	}

	/**
	 * Recupere 1 post
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function getPost($postId)
	{
	    $req = $this->db->prepare('SELECT id, author,title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}
}