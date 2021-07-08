<?php

/* @var $articles common\models\Article[] */
/* @var $settings array */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<?php if ($settings['h1']): ?>
    <h1 class="mb-3"><?= $settings['h1'] ?></h1>
<?php endif; ?>

<?php if ($settings['seoText1.show']): ?>
    <div class="mb-5"><?= $settings['seoText1.text'] ?></div>
<?php endif; ?>

<?php foreach ($articles as $article): ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if ($article['thumb']): ?>
                    <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
                        <img style="height: 100%;object-fit: cover;max-height: 200px" class="card-img" src="<?= $article['thumb'] ?>" alt="<?= $article['title'] ?>">
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>"><?= $article['title'] ?></a></h5>
                    <p class="card-text"><?= $article['short_text'] ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php if ($settings['seoText2.show']): ?>
    <?= $settings['seoText2.text'] ?>
<?php endif; ?>
