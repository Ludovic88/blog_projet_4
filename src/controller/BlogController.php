<?php

require("../core/Controller.php");
require_once('../src/model/PostManager.php');
require_once('../src/model/CommentManager.php');


class BlogController extends Controller
{
	public function recentPosts(){
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getRecentPosts(); // Appel d'une fonction de cet objet

		$this->render('frontend/recentpostview', [
	        'posts' => $posts,
	    ]);
	}

	public function allPosts(){
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getAllPosts(); // Appel d'une fonction de cet objet

		$this->render('frontend/allpostview', [
	        'posts' => $posts,
	    ]);
	}

	function post(){
		$postManager = new PostManager();
	    $commentManager = new CommentManager();

	    $post = $postManager->getPost($_GET['id']);
	    $comments = $commentManager->getComments($_GET['id']);

	    $this->render('frontend/postview', [
	        'post' => $post,
	        'comments' => $comments
	    ]);
	}
}