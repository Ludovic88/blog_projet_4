<?php

/**
 * Lance une session
 * Instancie les class 
 * Lance la fonction run du router qui va emmener ver le bon controller
 */
session_start();
require_once("../core/Helpers.php");
require("../core/Router.php");
$router = new Router();
$router->run();

//var_dump($_SESSION);
//var_dump(password_hash('Jean1234', PASSWORD_DEFAULT));