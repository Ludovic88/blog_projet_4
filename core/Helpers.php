<?php

/**
 * Variable constante qui a comme valeur le prefixe du chemin de l url
 */
define('PATH_PREFIX', '/courPHP/blog_projet_4');

/**
 * Fonction qui renvoie la class active dans les onglets de la navbar
 * Verifie si l'url conrespont au chemin indiquer dans la variable
 * Renvoie active si ca correspond
 */
function active($path){
	if ($_SERVER['REQUEST_URI'] == (PATH_PREFIX . $path)) {
		echo "active";
	}
}