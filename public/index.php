<?php

/**
 * Lance une session
 * Instanci les class 
 * Lance la fonction run du router qui va emmener ver le bon controller
 */
session_start();
require("../core/Router.php");
require_once("../core/Helpers.php");
$router = new Router();
$router->run();

//var_dump($_SESSION);
//var_dump(password_hash('test', PASSWORD_DEFAULT));