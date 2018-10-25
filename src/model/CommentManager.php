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
     * Fait une pagination tous les 5 commentaires
     * @param id du post $number
     * Retourne la variable $comments pour afficher les commentaire
     * Retourne $totalPages et $currentPage pour gerer la pagination dans la vue
     */
	public function getComments($postId)
	{
		$nbCommentPage = 5;
		$totalCommentsReq = $this->db->query('SELECT id FROM comments WHERE id_post =' . $postId);
		$totalComments = $totalCommentsReq->rowCount();
		$totalPages = ceil($totalComments/$nbCommentPage);

		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPages) {
			$_GET['page'] = intval($_GET['page']);
			$currentPage = $_GET['page'];
		} else {
			$currentPage = 1;
		}

		$depart = ($currentPage - 1) * $nbCommentPage;

	    $comments = $this->db->prepare('SELECT id,  id_post, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr, signal_count FROM comments WHERE id_post = ? ORDER BY date_comment DESC LIMIT ' . $depart . ', ' . $nbCommentPage);
	    $comments->execute(array($postId));

	    $test = [$comments, $totalPages, $currentPage];
	    return $test;
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

		/**
     * Enleve les signalements sur un commentaire
     * @param id du commentairet $number
     * Retourne le nouveau nombre de signalement
     */
	public function noSignalComment($id)
	{
		$comment = $this->db->prepare('UPDATE comments SET signal_count = 0 WHERE id = ?');
		$affectedCount = $comment->execute(array($id));

		return $affectedCount;
	}
}