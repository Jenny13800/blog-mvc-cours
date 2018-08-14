<h2><?= $errorMessage ?></h2>

<?php if(!$id_article): ?>
	<a href="index.php">Revenir à l'accueil</a>
<?php else: ?>
	<a href="article.php?id=<?= $id_article ?>">Revenir à l'article</a>

<?php endif; ?>