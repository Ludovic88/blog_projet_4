<?php

require("../core/Controller.php");
require_once('../src/model/PostManager.php');


class BlogController extends Controller
{
	public function recentPosts(){
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getRecentPosts(); // Appel d'une fonction de cet objet

		require('../views/frontend/recentpostview.php');
	}
}