<?php
namespace src\controller;
use \src\model\CommentManager;
use \src\model\PostManager;
use \src\model\AdminManager;
/**
 * Class AdminController
 * Controller qui gere la partie admin
 */
class AdminController extends \core\Controller
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
		$this->render('backend/createpostview');
	}

	/**
	 * Cree un nouveau post
	 */
	public function newPost()
	{
		$postManager = new PostManager();
		if(!$postManager->addNewPost($_POST['author'], $_POST['title'], $_POST['content'])){
			throw new Exception('Impossible d\'ajouter le post !');
		} else {
		    $this->redirect('/admin');
		}				
	}

	/**
	 * Accueil admin
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
     * Recupere le post et ses commentaire
     * Redirige vers la vue modifier commentaire
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
		        'comments' => $comments[0],
		        'totalPages' => $comments[1],
		        'currentPage' => $comments[2]
		    ]);   
        } else {
        	echo "post non existant";
        }
	}

	/**
	 * Requete administration de modification ou suppression de post
	 * Verifie Si la raquete est modifier ou supprimer
	 * Execute la requete
	 */
	public function configuratePost()
	{
		if (isset($_POST['modify'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
	            $postManager = new PostManager();

			    $post = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
	 
	 			$this->redirect('/admin');
        	} else {
        		echo "post non existant";
       		}
		} else if (isset($_POST['delete'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
	            $postManager = new PostManager();

			    $post = $postManager->deletePost($_GET['id']);
	 
	 			$this->redirect('/admin');
	        } else {
	        	echo "post non existant";
	        }
		}
	}

	/**
	 * Efface ou enleve les signalements un commentaire
	 */
	public function configurateComment()
	{
		if (isset($_POST['delete'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
            $commentManager = new CommentManager();

		    $comment = $commentManager->deleteComment($_GET['id']);
 
 			$this->redirectBack();
	        } else {
	        	echo "post non existant";
	        }
		} elseif (isset($_POST['nosignal'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
			$commentManager = new CommentManager();
			$affectedLines = $commentManager->noSignalComment($_GET['id']);

			$this->redirectBack();
			} else {
				echo "post non existant";
			}
		}
	}

	/**
	 * Recupere les donnees de l admin associe au pseudo
	 * verifie si le mdp est correct
	 * Si oui renvoie dans la partie admin
	 * Sinon affiche erreur
	 */
	public function adminConnect(){
		$adminManager = new AdminManager();
		if($adminManager->connect($_POST['pseudo'],$_POST['password'])){
			$this->redirect('/admin');
		}else{
		    echo 'Mauvais identifiant ou mot de passe !';
		}
	}

	/**
	 * Se deconnecte de la partie admin
	 * Session connect sur false
	 * Redirige ver l accueil visiteur
	 */
	public function disconect(){
		unset($_SESSION['connect']);
		$this->redirect('');
	}
	
	/**
	 * Redirige vers le login
	 */
	public function login(){
		$this->render('backend/adminconectview');
	}

	/**
     * Recupere le post et ses commentaire
     * Redirige vers la vue modifier commentaire
     */
	public function modarateComment()
	{
		$commentManager = new CommentManager();

		$comments = $commentManager->getSignalComments();

		$this->render('backend/commentsignalview', [
		    'comments' => $comments
		]);   
	}
}