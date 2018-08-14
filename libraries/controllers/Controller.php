<?php

class Controller {

	protected $viewFolder = 'articles';
	protected $modelName;
	protected $model;

	public function __construct() {
		$realModelName = ucfirst($this->modelName) . "Model";
		require_once('libraries/models/' . $realModelName . '.php');
		$this->model = new $realModelName();
	}

	//on lui passe en paramètres les variables externes à cette function dans un tableau
	protected function display($page, $variables = []){

		//prend la clé dans le tableau et transforme en var
		extract($variables);

		require_once('templates/header.php');

		require_once('templates/' . $this->viewFolder . '/'. $page . '.html.php');

		require_once('templates/footer.php');
	}

	public function index() {
		$this->display('index');
	}

	public function show() {
		$this->display('show');
	}

	public function create (){
		$this->display('new');
	}

	public function edit (){
		$this->display('edit');
	}

}

?>