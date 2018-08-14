<?php
require_once("libraries/controllers/Controller.php");

class DownloadsController extends Controller {
    protected $viewFolder = "downloads";
    protected $modelName = "downloads";

    public function index(){
        $downloads = $this->model->all();
        $this->display("index", ["downloads" => $downloads]);
    }

    public function show(){
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $download = [];
        $errorMessage = "";

        if(!$id){
            $errorMessage = "Vous n'avez pas envoyé l'id !";
        } else {
            $download = $this->model->find($id);

            if(!$download){
                $errorMessage = "Aucun élément trouvé pour l'id $id";
            } else {
                // on a un download 
                // on veut^mettre à jour le nb de click
                $this->model->click($id);
            }
        }

        $this->display("show", ["download" => $download]);
    }
}
