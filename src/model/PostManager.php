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
		$req = $this->db->query('SELECT id, author, title, post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_post');

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

	/**
	 * Cree un nouveau post 
	 * @param auteur du post $string
	 * @param titre du post $string
	 * @param contenu du post $string
	 * Retourne une variable
	 */
	public function addNewPost($author, $title, $post)
	{
		if (!empty($author) && !empty($title) && !empty($post) && isset($_SESSION['token']))
		{
			$newPost = $this->db->prepare('INSERT INTO posts (author, title, post, date_post) VALUES(?, ?, ?, NOW())');
		    $affectedPost = $newPost->execute(array($author, $title, $post));

		    return $affectedPost;
		}
	}

	/**
	 * Modifie un post
	 * @param titre du post $string
	 * @param contenu du post $string
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function updatePost($title, $post, $idPost)
	{
		$newPost = $this->db->prepare('UPDATE posts SET title = ?, post = ? WHERE id = ?');
		$affectedPost = $newPost->execute(array($title, $post, $idPost));

		return $affectedPost;
	}

	/**
	 * Supprime un post
	 * @param id du post $number
	 * Retourne une variable
	 */
	public function deletePost($idPost)
	{
		$deletedPost = $this->db->prepare('DELETE FROM posts WHERE posts . id = ?');
		$affectedPost = $deletedPost->execute(array($idPost));

		return $affectedPost;
	}
}