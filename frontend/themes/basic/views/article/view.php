<?php

/* @var $article common\models\Article */
/* @var $related common\models\Article[] */
/* @var $settings array */

use yii\helpers\Url;

?>

<h1><?= $article['title'] ?></h1>

<?php if ($settings['thumb.show']): ?>
    <img src="<?= $article['thumb']; ?>" style="max-width: 100%; display: block; margin: 0 auto;" alt=""/>
<?php endif; ?>

<?php if ($settings['tableContents.show'] && $article['table_contents']): ?>
    <p><b>Оглавление:</b></p>
    <?= $article['table_contents']; ?>
<?php endif; ?>

<?= htmlspecialchars_decode($article['text']) ?>

<?php if ($related): ?>
<h3><?= $settings['related.title'] ?></h3>
<div class="row">
    <?php foreach ($related as $article): ?>
        <div class="col-12 col-md-4">
            <div class="card">
                <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
                    <img style="height: 200px; object-fit: cover" src="<?= $article['thumb'] ?>" class="card-img-top" alt="<?= $article['title'] ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
                            <?= $article['title'] ?>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
