<?php
// Si on nous demande create et qu'on nous précise bien un nom
if($argv[1] == "create" && !empty($argv[2])){
    
    // Le deuxième paramètre c'est le nom de notre nouvelle partie de site
    $name = $argv[2];

    // On créé le fichier qui contient le controller
    createController($name);
    // On créé le fichier qui contient le model
    createModel($name);
    // On créé le dossier des vues et les vues index et show
    createViews($name);
}

function createController($name){
    // pour downloads, on doit avoir DownloadsController
    $controllerName = ucfirst($name) . 'Controller';
    echo "\nCreating controller $controllerName";

    // Le sigulier pour downloads c'est download (on enlève la dernière lettre)
    $singulier = substr($name, 0, -1);

    // Contenu du fichier controller
    $content = '<?php
require_once("libraries/controllers/Controller.php");

class '.$controllerName.' extends Controller {
    protected $viewFolder = "'.$name.'";
    protected $modelName = "'.$name.'";

    public function index(){
        $'.$name.' = $this->model->all();
        $this->display("index", ["'.$name.'" => $'.$name.']);
    }

    public function show(){
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $'.$singulier.' = [];
        $errorMessage = "";

        if(!$id){
            $errorMessage = "Vous n\'avez pas envoyé l\'id !";
        } else {
            $'.$singulier.' = $this->model->find($id);

            if(!$'.$singulier.'){
                $errorMessage = "Aucun élément trouvé pour l\'id $id";
            }
        }

        $this->display("show", ["'.$singulier.'" => $'.$singulier.']);
    }
}
';
    // On ajoute le contenu dans le fichier php
    file_put_contents('libraries/controllers/' . $controllerName . '.php', $content);    
}

function createModel($name){
    // Pour downloads on veut DownloadsModel 
    $modelName = ucfirst($name) . 'Model';
    echo "\nCreating model $modelName";

    // Contenu du fichier
    $content = '<?php
require_once("libraries/models/Model.php");

class '.$modelName.' extends Model {
    protected $tableName = "'.$name.'";
}
';
    // On écrit le contenu dans le fichier PHP
    file_put_contents('libraries/models/' . $modelName . '.php', $content);    
}

function createViews($name){
    // Si le dossier des vues n'existe pas
    echo "\n\nCreating views index & show";
    if(!file_exists("templates/$name")){
        echo "\nCreating templates folder $name";
        // On créé le dossier
        mkdir("templates/$name");
    }
    // On créé l'index
    createIndex($name);
    // On créé le show
    createShow($name);
}

function createIndex($name){
    echo "\nCreating view templates/$name/index.html.php";

    // Contenu du fichier index (qui fait une boucle et var_dump les items)
    $content = '<h2>'.ucfirst($name).' Index</h2>
<h3>To modify this, go in templates/'.$name.'/index.html.php !</h3>
<?php foreach($'.$name.' as $item) : ?>
    <?php var_dump($item) ?>
    <a href="index.php?controller='.$name.'&task=show&id=<?= $item["id"] ?>">READ MORE</a>
    <hr>
<?php endforeach; ?>
    ';
    // On écrit le contenu dans le fichier PHP
    file_put_contents("templates/$name/index.html.php", $content);
}


function createShow($name){
    echo "\nCreating view templates/$name/show.html.php";

    // Pour downloads on veut download (on enlève la dernière lettre)
    $singulier = substr($name, 0, -1);

    // Contenu du fichier
    $content = '<h2>'.ucfirst($name).' Show for ID : <?= $'.$singulier.'["id"] ?></h2>
<h3>To modify this, go in templates/'.$name.'/show.html.php !</h3>
<?php var_dump($'.$singulier.') ?>
';
    // On écrit le contenu dans le fichier PHP
    file_put_contents("templates/$name/show.html.php", $content);
}