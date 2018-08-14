<h2>Liste des téléchargements</h2>

<?php foreach ($downloads as $download) : ?>
	<h3>Titre : <?= $download['titre'] ?></h3>
	<a href="index.php?controller=downloads&task=show&id=<?= $download['id'] ?>"><p>Accéder à la description</p></a>
<?php endforeach ?>