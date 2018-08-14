<?php

// Par défaut, notre site se sert du controller des articles
$defaultController = 'articles';

// Si jamais on exprime le souhait d'utiliser un autre controller (par exemple : users ou commentaires)
if(!empty($_GET['controller'])){
	$defaultController = $_GET['controller'];
}

// On déduit du controller demandé, son véritable nom (articles => ArticlesController, users => UsersController)
$controllerName = ucfirst($defaultController) . "Controller";

// On require le fichier qui contient le controller demandé (ArticlesController.php ou encore UsersController.php)
require_once("libraries/controllers/" . $controllerName . ".php");

// On intancie un objet de la classe du controller demandé
$controller = new $controllerName();

// t$ache par défaut
$task = "index";

// on prend en compte la demande éventuelle utilisateur
if(!empty($_GET['task'])){
	$task = $_GET['task'];
}

/*switch($task){
	case "index":
		$controller->index();
		break;
	case "show":
		$controller->show();
		break;
	case "print":
		$controller->print();
		break;
}*/

//var_dump($task);

//$controller->index();
// récupère la valeur dans task par défaut index
$controller->$task();


?>