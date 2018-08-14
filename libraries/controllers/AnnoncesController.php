<?php
require_once("libraries/controllers/Controller.php");

class AnnoncesController extends Controller {
    protected $viewFolder = "annonces";
    protected $modelName = "annonces";

    public function index(){
        $annonces = $this->model->all();
        $this->display("index", ["annonces" => $annonces]);
    }

    public function show(){
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $annonce = [];
        $errorMessage = "";

        if(!$id){
            $errorMessage = "Vous n'avez pas envoyé l'id !";
        } else {
            $annonce = $this->model->find($id);

            if(!$annonce){
                $errorMessage = "Aucun élément trouvé pour l'id $id";
            }
        }

        $this->display("show", ["annonce" => $annonce]);
    }
}
