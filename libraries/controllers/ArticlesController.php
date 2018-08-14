<?php

//1. connexion à la bdd 
require_once("libraries/controllers/Controller.php");
require_once('libraries/models/CommentairesModel.php');

class ArticlesController extends Controller {

	protected $viewFolder = "articles";
	protected $modelName = "articles";

	public function edit() {

		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		$article = $this->model->find($id);

		$this->display('edit', ['article' => $article]);
	}

	public function update() {
		$auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$contenu = filter_input(INPUT_POST, 'contenu');

		$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

		if(!$auteur || !$titre || !$contenu || !$id) {
			die("Il manque des informations");
		} else {
			$this->model->update([
				"auteur" => $auteur,
				"contenu" => $contenu,
				"titre" => $titre,
				"image" => $image,
				"id" => $id
			]);

			header('Location: index.php?controller=articles&task=show&id=' . $id);
		}
	}

	public function create() {
		$this->display('create');
	}

	public function save() {
		//var_dump($_POST);
		$auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$contenu = filter_input(INPUT_POST, 'contenu');

		$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if(!$auteur || !$titre || !$contenu) {
			die("Il manque des informations");
		} else {
			$this->model->insert([
				"auteur" => $auteur,
				"contenu" => $contenu,
				"titre" => $titre,
				"image" => $image,
				"date_creation" => date("Y-m-d H:i:s")
			]);

			$id = $this->model->lastInsertId();

			header('Location: index.php?controller=articles&task=show&id=' . $id);
		}
	}

	public function index() {

		// Récupères les articles : utilise la function dans database.php
		//$articles = getArticles();
		//$model = new ArticlesModel();
		$articles = $this->model->all();
		// Affiche de la vue index.html.php
		$this->display('index', ['articles' => $articles]); 

	}

	public function show() {
		// Initialises les variabes pour éviter les erreurs php
		$article = [];
		$commentaires = [];

		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		$errorMessage = '';

		if(!$id) {
			$errorMessage = "Vous n'avez pas envoyé d'identifiant pour l'article";

			//var_dump($id);

		//die();

		//$id = $_GET['id'];
		} else {

			// récupération de l'article
			//$article = getArticle($id);
			//$model = new ArticlesModel();
			$article = $this->model->find($id);

			//var_dump($article);
			//car si pas de résultat php renvoie false donc !$article
			if(!$article){
				$errorMessage = "Aucun article trouvé avec l'identifiant $id";
			}
			
			//$commentaires = getCommentaires($id);
			$commentairesModel = new CommentairesModel();
			$commentaires = $commentairesModel->all('id_article = ' . $id);

		}

		$this->display('show', [
			'commentaires' => $commentaires, 
			'article' => $article, 
			'id' => $id, 
			'errorMessage' => $errorMessage
		]);
	}

}

?>