<?php //recupere lurl instancie le bon controller et execute la bonne fonction

class Router
{

	/*private $router = [
		"billets" => [
			"path" => "/blog", 
			"run" => "BlogController@listPosts"
		]
	];*/

	private $_index = "/courPHP/blog_projet_4/";


	private $_router = [
	"/courPHP/blog_projet_4/" => 'BlogController@recentPosts',
    "/courPHP/blog_projet_4/blog" => 'BlogController@allPosts',
    "/courPHP/blog_projet_4/commentaire" => 'BlogController@post',
    "/courPHP/blog_projet_4/admin" => 'AdminController@adminView'
	];

	public function run(){
		$uri = explode('?', $_SERVER['REQUEST_URI']);
		foreach($this->_router as $key => $route) {
			if ($uri[0] == $key) {
				$test = explode('@', $route);
				require_once('../src/controller/' . $test[0] . '.php');
				$controller = new $test[0]();
				$view = $controller->{$test[1]}();
			} 
		}
	}
}