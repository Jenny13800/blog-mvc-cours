<?php

class Model {

	protected $db;

	protected $tableName = "articles";

	public function __construct() {
		// Il faut établir la connexion à la base
		$this->db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','', [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
	}

	public function all($where = '', $order = ''){

		$sql =  'SELECT * FROM ' . $this->tableName;

		if($where){
			$sql .= " WHERE " . $where;
		}

		if($order){
			$sql .= " ORDER BY " . $order;
		}

		$resultat = $this->db->query($sql);

		return $resultat->fetchAll();
	}

	// ici on recçoit un id donc on prepare
	public function find($id){
		$requete = $this->db->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id = :id');
		
		$requete->execute([
			':id' => $id
		]);

		return $requete->fetch();
	}

	public function insert($data) {
		// 1. Il faut écrire la requête

		// INSERT INTO commentaires SET contenu = :contenu, auteur = :auteur, id_article = :id_article, date_creation = NOW()

		$sql = 'INSERT INTO ' . $this->tableName . ' SET ';

		//Il faut créer l'espace avec les tokens
		//$champs = '';
		$champs = [];


		//on parcours le tebleau de données
		foreach($data as $cle => $donnee) {
			// $champs = $champs . "$cle = : $cle"
			//$champs .= "$cle = :$cle, ";
			$champs[] = "$cle = :$cle";
		}

		//var_dump($champs);

		$champs = join(", ", $champs);

		// Ajoute les tokens à sql
		// concatène la requête sql avec le tableau de $champs
		$sql .= $champs;

		//var_dump($sql);

		$requete = $this->db->prepare($sql);

		// On crée un tableau des tokens
		$tokens = [];

		foreach($data as $cle => $donnee) {
			$tokens[":$cle"] = $donnee;
		}

		// on lance la requête => envoie dans la bdd table commentaires
		$requete->execute($tokens);

		//var_dump($tokens);
	}

	// "ex : date_creation > 2017/10/10"
	public function update($data, $where = '') {
		// 1. Il faut écrire la requête

		// INSERT INTO commentaires SET contenu = :contenu, auteur = :auteur, id_article = :id_article, date_creation = NOW()

		$sql = 'UPDATE ' . $this->tableName . ' SET ';

		//Il faut créer l'espace avec les tokens
		//$champs = '';
		$champs = [];


		//on parcours le tebleau de données
		foreach($data as $cle => $donnee) {
			// $champs = $champs . "$cle = : $cle"
			//$champs .= "$cle = :$cle, ";
			$champs[] = "$cle = :$cle";
		}

		//var_dump($champs);

		$champs = join(", ", $champs);

		// Ajoute les tokens à sql
		// concatène la requête sql avec le tableau de $champs
		$sql .= $champs;

		// Précise en WHERE l'identifiant ou si where n'est pas vide alors tu fais ça
		//$sql .= " WHERE id = " . $data['id'];
		if(!$where) {
			$sql .= " WHERE id = " . $data['id'];
		} else {
			$sql .= " WHERE " . $where;
		}
		
		//var_dump($sql);

		$requete = $this->db->prepare($sql);

		// On crée un tableau des tokens
		$tokens = [];

		foreach($data as $cle => $donnee) {
			$tokens[":$cle"] = $donnee;
		}

		// on lance la requête => envoie dans la bdd table commentaires
		$requete->execute($tokens);

		//var_dump($tokens);
	}

	public function delete($id){
		$this->db->query('DELETE FROM ' . $this->tableName . ' WHERE id = ' . $id);
	}

	public function lastInsertId(){
		return $this->db->lastInsertId();
	}
}

 ?>