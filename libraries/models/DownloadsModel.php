<?php
require_once("libraries/models/Model.php");

class DownloadsModel extends Model {
    protected $tableName = "downloads";

    public function click($id) {
    	$requete = $this->db->prepare('UPDATE downloads SET clicks = clicks + 1 WHERE id = :id');

    	$requete->execute([
    		':id' => $id
    	]);
    }
}
