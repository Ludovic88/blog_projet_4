<?php
namespace blogApp\src\controller;
use \blogApp\src\model\CommentManager;
use \blogApp\src\model\PostManager;
/**
 * Class BlogController
 * controler frontend
 */
class BlogController extends \blogApp\core\Controller
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
		        'comments' => $comments[0],
		        'totalPages' => $comments[1],
		        'currentPage' => $comments[2]
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
		if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])){
				$commentManager = new CommentManager();
			    $affectedLines = $commentManager->postComment($_GET['id'], $_POST['author'], $_POST['comment']);

			    if ($affectedLines === false) {
			        \blogApp\core\MessageAlert::messageType('danger', 'Le commentaire n\'a pu être posté réessayer plus tard');
			        $this->redirectBack();
			    }
			    else {
			    	\blogApp\core\MessageAlert::messageType('success', 'Le commentaire a bien été posté, merci');
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

	/**
     * Redirige vers la page contact
     */
	public function contact()
	{
		$this->render('frontend/contactview');
	}
}