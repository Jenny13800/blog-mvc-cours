<?php

require_once("libraries/controllers/Controller.php");

class CommentairesController extends Controller {

	protected $viewFolder = "commentaires";
	protected $modelName = "commentaires";

	public function create() {
		$auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		// je récupère l'article dans le POST en le sécurisant 
		$contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		// je récupère l'id dans le POST en le sécurisant  (ça doit être un int)
		$id_article = filter_input(INPUT_POST, 'id_article', FILTER_VALIDATE_INT);

		$errorMessage= '';

		if(!$auteur){
			$errorMessage= "Vous n'avez pas rempli le champ auteur!";
		} else if(!$contenu) {
			$errorMessage= "Vous n'avez pas rempli le champ contenu!";
		} else if (!$id_article) {
			$errorMessage= "Nous n'avons pas trouvé l'article que vous voulez commenter!";
		} else {

			$this->model->insert([
				'auteur' => $auteur,
				'contenu' => $contenu,
				'id_article' => $id_article,
				'date_creation' => date('Y-m-d H:i:s')
			]);
			//createCommentaires($auteur, $contenu, $id_article);

			header('Location: index.php?task=show&id=' . $id_article);

			// on veut que le code s'arrête ici / alias de die
			exit();
		}

		require_once('templates/header.php');

		//var_dump($_POST);

		require_once('templates/articles/error.html.php');

		require_once('templates/footer.php'); 
	}

	public function index() {

		$commentaires = $this->model->all();
		//$commentaires = getAllCommentaires();

		$this->display('index', ['commentaires' => $commentaires]);

	}

}

?>