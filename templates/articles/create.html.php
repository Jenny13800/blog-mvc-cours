<form action="index.php?controller=articles&task=save" method="POST">
	<h2>Création d'un article</h2>
	<input type="text" name="titre" placeholder="Tapez le titre" required>
	<input type="text" name="auteur" placeholder="Tapez l'auteur" required>
	<textarea name="contenu" placeholder="Tapez le contenu" required></textarea>
	<input type="text" name="image" placeholder="URL de l'image" required>
	<button type="submit">Créer l'article</button>
</form>

