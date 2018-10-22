<?php
require("../core/Controller.php");
require_once('../src/model/PostManager.php');
require_once('../src/model/CommentManager.php');

/**
 * Class AdminController
 * Contrller qui gere la partie admin
 */
class AdminController extends Controller
{
	/**
	 * Nouvelle valeur pour la variable template cree dans le controller principale
	 */
	protected $template = 'backend/template';


	/**
	 * Renvoie la page d'edition d'admin
	 */
	public function editPost()
	{
		ob_start();
		require('../views/backend/createpostview.php');
		$content = ob_get_clean();
		require('../views/' . $this->template . '.php');
	}

	/**
	 * Cree un nouveau post
	 */
	public function newPost()
	{
		if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content']))
		{
			$postManager = new PostManager();
			$affectedPost = $postManager->addNewPost($_POST['author'], $_POST['title'], $_POST['content']);

			if ($affectedPost === false) {
			    throw new Exception('Impossible d\'ajouter le post !');
			}
			else {
			    $this->redirectBack();
			}		
		}
	}

	/**
	 *Accueil admin
     * Recupere tout les posts via la fonction du modele
     * Redirige vers la vue
     */
	public function allPostsAdmin(){
		$postManager = new PostManager();
	    $posts = $postManager->getAllPosts(); 

		$this->render('backend/adminallpostview', [
	        'posts' => $posts,
	    ]);
	}


	/**
	 * Modifie un post
	 */
	public function modaratePost()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostManager();
		    $commentManager = new CommentManager();

		    $post = $postManager->getPost($_GET['id']);
		    $comments = $commentManager->getComments($_GET['id']);

		    $this->render('backend/modifypostview', [
		        'post' => $post,
		        'comments' => $comments
		    ]);   
        } else {
        	echo "post non existant";
        }
	}

	/**
	 * Modifie un post
	 */
	public function modifyPost()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostManager();

		    $post = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
 
 			header('Location: /courPHP/blog_projet_4/admin');
        } else {
        	echo "post non existant";
        }
	}

	/**
	 * Efface un post
	 */
	public function deletedPost()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostManager();

		    $post = $postManager->deletePost($_GET['id']);
 
 			header('Location: /courPHP/blog_projet_4/admin');
        } else {
        	echo "post non existant";
        }
	}

	/**
	 * Efface un commentaire
	 */
	public function deletedComment()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $commentManager = new CommentManager();

		    $comment = $commentManager->deleteComment($_GET['id']);
 
 			$this->redirectBack();
        } else {
        	echo "post non existant";
        }
	}
	
}