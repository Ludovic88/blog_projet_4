<?php 
namespace core;
/**
 * Class Router
 * Recupere l url et instancie le bon controller et execute la bonne fonction
 */
class Router
{

	/**
	 * Tableau $_router
	 * Stock le chemin qui suit l'url de l index dans la clef
	 *  => Associe le chemin au controller a instancier @ Associe la fonction
	 */
	private $_router = [
	'/' => '\src\controller\BlogController@recentPosts',
    '/blog' => '\src\controller\BlogController@allPosts',
    '/post' => '\src\controller\BlogController@post',
    '/addcomment' => '\src\controller\BlogController@addComment',
    '/signalcomment' => '\src\controller\BlogController@signalComment',
    '/admin' => '\src\controller\AdminController@allPostsAdmin',
    '/admin/editer-chapitre' => '\src\controller\AdminController@editPost',
    '/admin/modifier-chapitre' => '\src\controller\AdminController@modaratePost',
    '/admin/newpost' => '\src\controller\AdminController@newPost',
    '/admin/configurepost' => '\src\controller\AdminController@configuratePost',
    '/admin/configurecomment' => '\src\controller\AdminController@configurateComment',
    '/admin/comment' => '\src\controller\AdminController@modarateComment',
    '/verifypass' => '\src\controller\AdminController@adminConnect',
    '/deconnexion' => '\src\controller\AdminController@disconect',
    '/admin-login' => '\src\controller\AdminController@login'
	];


	/**
	 * Pour separe les requete GET_ de l url actuel on le separe avec un explode
	 * On remplace le chemin de l'index de l url actuel par un vide avec str_replace 
	 * On verifie si on est dans la partie admin
	 * Si on est pas connecter et quon veut acceder a la partie admin -> login 
	 * Sinon compare l'url actuelle a la clef $_router avec un foreach
	 * Instancie le controller
	 * Appele la fonction
	 */
	public function run(){
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		$path = str_replace(PATH_PREFIX ,"",$uri[0]);

		$adminVerify = explode('/', $path);

		if (isset($_POST['token']) && $_POST['token'] != $_SESSION['token']) {
			die('le jeton est périmé');
		} elseif (isset($adminVerify[1]) && $adminVerify[1] == 'admin' && !isset($_SESSION['connect'])) {
			header('location: ' . PATH_PREFIX . '/admin-login');
			exit();
		} else {
			foreach($this->_router as $key => $route) {
				if ($path == $key) {
					$run = explode('@', $route);
					$controller = new $run[0]();
					$controller->{$run[1]}();
				} 
			}
		}
	}
}