<?php

require("../core/Controller.php");
require_once('../src/model/PostManager.php');
require_once('../src/model/CommentManager.php');

/**
 * Class BlogController
 * controler frontend
 */
class BlogController extends Controller
{
	protected $template = 'frontend/template';

	/**
     * Recupere le dernier post via la fonction du modele
     * Redirige vers la vue
     */
	public function recentPosts(){
		$postManager = new PostManager(); 
	    $posts = $postManager->getRecentPosts(); 

		$this->render('frontend/recentpostview', [
	        'posts' => $posts,
	    ]);
	}

	/**
     * Recupere tout les posts via la fonction du modele
     * Redirige vers la vue
     */
	public function allPosts(){
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getAllPosts(); // Appel d'une fonction de cet objet

		$this->render('frontend/allpostview', [
	        'posts' => $posts,
	    ]);
	}

	/**
     * Recupere le post et ses commentaire
     * Redirige vers la vue
     */
	public function post(){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostManager();
		    $commentManager = new CommentManager();

		    $post = $postManager->getPost($_GET['id']);
		    $comments = $commentManager->getComments($_GET['id']);

		    $this->render('frontend/postview', [
		        'post' => $post,
		        'comments' => $comments
		    ]);   
        } else {
        	echo "post non existant"; // créer une alerte Alert::set('message','error')
        }
	}

	/**
     * Recupere l id du post
     * rajoute le commentaire au post
     * Redirige vers la vue
     */
	public function addComment()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['token'])) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])){
				$commentManager = new CommentManager();
			    $affectedLines = $commentManager->postComment($_GET['id'], $_POST['author'], $_POST['comment']);

			    if ($affectedLines === false) {
			        throw new Exception('Impossible d\'ajouter le commentaire !');
			    }
			    else {
			        $this->redirectBack();
			    }		
			}
		}
	}

	/**
     * Recupere l id du commentaire
     * Ajoute +1 au compteur de signalement du commentaire
     * Redirige vers la vue
     */
	public function signalComment()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$commentManager = new CommentManager();
			$affectedLines = $commentManager->addSignalComment($_GET['id']);

			$this->redirectBack();
		} else {
			echo "post non existant";
		}
	}
}