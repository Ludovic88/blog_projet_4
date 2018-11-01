<?php
namespace blogApp\src\controller;
use \blogApp\src\model\CommentManager;
use \blogApp\src\model\PostManager;
use \blogApp\src\model\AdminManager;
/**
 * Class AdminController
 * Controller qui gere la partie admin
 */
class AdminController extends \blogApp\core\Controller
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
			messageSucces("error", "Impossible de posté votre chapitre réessayer plus tard");
		    $this->redirect('/admin');
		} else {
			messageSucces("succes", "Votre chapitre a été posté avec succès");
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
	 
	 			messageSucces("succes", "Votre chapitre a été modifié avec succès");
	 			$this->redirect('/admin');
        	} else {
        		messageSucces("error", "Votre chapitre n'a pas été modifié réessayer plus tard");
	 			$this->redirect('/admin');
       		}
		} else if (isset($_POST['delete'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
	            $postManager = new PostManager();

			    $post = $postManager->deletePost($_GET['id']);
	 
	 			messageSucces("succes", "Votre chapitre a été supprimé avec succès");
	 			$this->redirect('/admin');
	        } else {
	        	messageSucces("error", "Votre chapitre n'a pas été supprimé réessayer plus tard");
	 			$this->redirect('/admin');
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
	 
	 			messageSucces("succes", "Le commentaire a été supprimé avec succès");
	 			$this->redirectBack();
	        } else {
	        	messageSucces("error", "Le commentaire n'a pas été supprimé réessayer plus tard");
	        	$this->redirectBack();
	        }
		} elseif (isset($_POST['nosignal'])) {
			if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['token'])) {
				$commentManager = new CommentManager();
				$affectedLines = $commentManager->noSignalComment($_GET['id']);

				messageSucces("succes", "Les signalement ont été réinitialisé");
	 			$this->redirectBack();
			} else {
				messageSucces("error", "Les signalement n'ont pas pus etre réinitialisé réessayer plus tard");
	        	$this->redirectBack();
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
			messageSucces("succes", "Bienvenue dans la partie administration " . $_POST['pseudo']);
			$this->redirect('/admin');
		}else{
			messageSucces("error", "Mauvais identifiant ou mauvais mot de passe !");
		    $this->redirectBack();
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