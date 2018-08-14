<?php

//1. connexion à la bdd 
require_once("libraries/controllers/Controller.php");

class DownloadsController extends Controller {

	protected $viewFolder = "downloads";
	protected $modelName = "downloads";

	public function index() {
		$downloads = $this->model->all();

		//var_dump($downloads);

		$this->display('index', ['downloads' => $downloads]);
	}

	public function show() {

		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		$download= [];
		$errorMessage = '';

		if(!$id) {

			$errorMessage = "Vous n'avez pas envoyé d'identifiant pour l'article";

		} else {

			$download = $this->model->find($id);


			if(!$download){
				$errorMessage = "Aucun article trouvé avec l'identifiant $id";
			}
			
		}

		$this->display('show', [
			'download' => $download
		]);
	} 

}

?>