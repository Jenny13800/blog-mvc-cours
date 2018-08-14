<form action="index.php?controller=articles&task=update" method="POST">
	<h2>Modification d'un article</h2>
	<input type="text" name="titre" placeholder="Tapez le titre" value="<?= $article['titre'] ?>" required>
	<input type="text" name="auteur" placeholder="Tapez l'auteur" value="<?= $article['auteur'] ?>" required>
	<textarea name="contenu" placeholder="Tapez le contenu" required><?= $article['contenu'] ?></textarea>
	<input type="text" name="image" placeholder="URL de l'image" value="<?= $article['image'] ?>" required>
	<input type="hidden" name="id" value="<?= $article['id'] ?>">
	<button type="submit">Modifier l'article</button>
</form>

