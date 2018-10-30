<?php
/**
 * Lance une session
 * Instancie les class 
 * Lance la fonction run du router qui va emmener ver le bon controller
 */
session_start();
require('../core/Autoloader.php');
\core\Autoloader::register();
require('../src/Autoloader.php');
\src\Autoloader::register();
//On Verifie si le jeton token existe Si non on le cree Si oui on passe a la suite
if (!isset($_SESSION['token'])) {
	$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$_SESSION['token'] = $token;
}

require_once("../core/Helpers.php");
$router = new \core\Router();
$router->run();

//var_dump($_SESSION);
//var_dump(password_hash('Jean1234', PASSWORD_DEFAULT));