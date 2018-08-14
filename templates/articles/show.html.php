<?php if($errorMessage) :?>
	<h2><?= $errorMessage ?></h2>
	<a href="index.php">Revenir à l'accueil</a>
<?php else : ?>
		<section class="article">
			<article>
				<h2><?= $article['titre']?></h2>
				<img src="<?= $article['image']?>" alt="">
				<p<?= $article['contenu']?></p>
			</article>
		</section>
		<section class="commentaires">
		<?php foreach ($commentaires as $commentaire) : ?>
			<div class="commentaire">
				<h3><?= $commentaire['auteur']?>, le <?= $commentaire['date_creation']?></h3>
				<blockquote><?= $commentaire['contenu']?></blockquote>
			</div>
		<?php endforeach; ?>
		</section>
		<form action="index.php?controller=commentaires&task=create" method="POST">
			<h2>Réagissez à l'article :</h2>
			<input type="text" placeholder="Votre pseudo !" name="auteur">
			<textarea name="contenu" placeholder="Votre réaction !"></textarea>
			<input type="hidden" name="id_article" value="<?= $id ?>">
			<button type="submit">Réagir !</button>
		</form>
	<?php endif; ?>