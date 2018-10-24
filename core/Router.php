<?php 

/**
 * Class Router
 * Recupere l url et instancie le bon controller et execute la bonne fonction
 */
class Router
{

	/**
	 * Variable qui stock l'url de l'index
	 */
	private $_index = "/courPHP/blog_projet_4";

	/**
	 * Tableau $_router
	 * Stock le chemin qui suit l'url de l index dans la clef
	 *  => Associe le chemin au controller a instancier @ Associe la fonction
	 */
	private $_router = [
	'/' => 'BlogController@recentPosts',
    '/blog' => 'BlogController@allPosts',
    '/post' => 'BlogController@post',
    '/addcomment' => 'BlogController@addComment',
    '/signalcomment' => 'BlogController@signalComment',
    '/admin' => 'AdminController@allPostsAdmin',
    '/admin-editer-chapitre' => 'AdminController@editPost',
    '/admin-modifier-chapitre' => 'AdminController@modaratePost',
    '/admin/newpost' => 'AdminController@newPost',
    '/admin/updatepost' => 'AdminController@modifyPost',
    '/admin/deletepost' => 'AdminController@deletedPost',
    '/admin/deletecomment' => 'AdminController@deletedcomment',
    '/verifypass' => 'AdminController@adminConnect',
    '/deconnexion' => 'AdminController@disconect'
	];


	/**
	 * Pour separe les requete GET_ de l url actuel on le separe avec un explode
	 * On remplace le chemin de l'index de l url actuel par un vide avec str_replace 
	 * Compare l'url actuelle a la clef $_router avec un foreach
	 * Instancie le controller
	 * Appele la fonction
	 */
	public function run(){
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		$path = str_replace($this->_index,"",$uri[0]);

		$adminVerify = explode('/', $path);
		$adminPath = explode('-', $adminVerify[1]);

		if ($adminPath[0] == 'admin' &&  $_SESSION['connect'] == false) {
			ob_start();
			require('../views/backend/adminconectview.php');
			$content = ob_get_clean();
			require('../views/frontend/template.php');
		} else {
			foreach($this->_router as $key => $route) {
				if ($path == $key) {
					$run = explode('@', $route);
					require_once('../src/controller/' . $run[0] . '.php');
					$controller = new $run[0]();
					$controller->{$run[1]}();
				} 
			}
		}

		// vérifier si partie admin
		// failles csrf
		
		
	}
}