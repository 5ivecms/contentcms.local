<?php

/* @var $articles common\models\Article[] */
/* @var $title string */

use yii\helpers\Url;

?>

<?php if ($title): ?>
    <h5><?= $title ?></h5>
<?php endif; ?>

<ul>
    <?php foreach ($articles as $article): ?>
    <li><a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>"><?= $article['title'] ?></a></li>
    <?php endforeach; ?>
</ul>
