<h2>Annonces Index</h2>
<h3>To modify this, go in templates/annonces/index.html.php !</h3>
<?php foreach($annonces as $item) : ?>
    <?php var_dump($item) ?>
    <a href="index.php?controller=annonces&task=show&id=<?= $item["id"] ?>">READ MORE</a>
    <hr>
<?php endforeach; ?>
    