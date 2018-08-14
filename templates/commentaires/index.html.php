<h2>Liste des commentaires : </h2>

<?php foreach($commentaires as $commentaire): ?>
	<div class="commentaire">
		<h3><?= $commentaire['auteur'] ?></h3>
		<p><?= $commentaire['contenu'] ?></p>
	</div>
<?php endforeach; ?>