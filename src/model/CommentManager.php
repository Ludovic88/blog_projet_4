<?php
require_once("../core/Model.php");

/**
 * Class CommentManager
 * Model qui gere les commentaires
 */
class CommentManager extends Model
{
	/**
     * Recupere les commentaire d'un post
     * @param id du post $number
     * Retourne les commentaires
     */
	public function getComments($postId)
	{
	    $comments = $this->db->prepare('SELECT id, id_post, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr, signal_count FROM comments WHERE id_post = ? ORDER BY date_comment DESC');
	    $comments->execute(array($postId));

	    return $comments;
	}

	/**
     * Rajoute un commentaire a un post
     * @param id du post $number
     * @param auteur du commentaire $string
     * @param commentaire $string
     * Retourne le nouveau commentaire
     */
	public function postComment($postId, $author, $comment)
	{
	    $comments = $this->db->prepare('INSERT INTO comments (id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

	    return $affectedLines;
	}

	//recupere un commentaire
	public function getComment($id)
	{
	    $comment = $this->db->prepare('SELECT id, id_post, comment, author FROM comments WHERE id = ? ');
	    $comment->execute(array($id));

	    return $comment;
	}

	public function editComment($newComment, $id)
	{
		$comment = $this->db->prepare('UPDATE comments SET comment= ?, date_comment = NOW() WHERE id = ?');
		$affectedComment = $comment->execute(array($newComment, $id));

		return $affectedComment;
	}

	/**
     * Signal le commentaire d'un post
     * @param id du commentairet $number
     * Retourne le nouveau nombre de signalement
     */
	public function addSignalComment($id)
	{
		$comment = $this->db->prepare('UPDATE comments SET signal_count = signal_count + 1 WHERE id = ?');
		$affectedCount = $comment->execute(array($id));

		return $affectedCount;
	}

		/**
	 * Supprime un commentaire
	 * @param id du commentaire $number
	 * Retourne une variable
	 */
	public function deleteComment($idComment)
	{
		$deletedComment = $this->db->prepare('DELETE FROM comments WHERE comments . id = ?');
		$affectedComment = $deletedComment->execute(array($idComment));

		return $affectedComment;
	}
}