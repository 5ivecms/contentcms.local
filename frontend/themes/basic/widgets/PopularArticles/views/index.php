<?php

/* @var $articles common\models\Article[] */
/* @var $title string */

use yii\helpers\Url;

?>

<div id="popular-posts" class="widget widget_categories">
    <?php if ($title): ?>
        <div class="widget-header"><?= $title ?></div>
    <?php endif; ?>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li><a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>"><?= $article['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
