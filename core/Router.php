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
    "/courPHP/blog_projet_4/blog" => 'BlogController@recentPosts',
    "/courPHP/blog_projet_4/admin" => 'AdminController@adminView'
	];

	public function run(){
		// recupere lurl instancie le bon controller et execute la bonne fonction
		if ($_SERVER['REQUEST_URI'] != $this->_index) {
			# code...
			foreach($this->_router as $key => $route) {
				if ($_SERVER['REQUEST_URI'] == $key) {
					# code...
					$test = explode('@', $route);
					require_once('../src/controller/' . $test[0] . '.php');
					$controller = new $test[0]();
					$view = $controller->{$test[1]}();
					return $view;
				} 
			}
		} else {
			echo "fuck";
		}
	}
}