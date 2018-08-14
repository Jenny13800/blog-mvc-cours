	<section class="articles">
			<?php foreach ($articles as $article): ?>
				<article>
					<h2><?= $article['titre'] ?></h2>
					<p><?= substr(strip_tags($article['contenu']), 0, 200) ?>...</p>
					<img src="<?= $article['image'] ?>" alt="">
					<a href="index.php?task=show&id=<?= $article['id'] ?>" class="special">Lire la suite</a>
				</article>
			<?php endforeach; ?>
	</section>
