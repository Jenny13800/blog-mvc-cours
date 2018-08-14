<h2>Downloads Index</h2>
<h3>To modify this, go in templates/downloads/index.html.php !</h3>
<?php foreach($downloads as $item) : ?>
    <?php var_dump($item) ?>
    <a href="index.php?controller=downloads&task=show&id=<?= $item["id"] ?>">READ MORE</a>
    <hr>
<?php endforeach; ?>
    