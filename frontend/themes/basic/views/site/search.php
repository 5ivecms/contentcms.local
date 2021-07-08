<?php

/* @var $articles common\models\Article[] */

/* @var $pages array */
/* @var $pageTitle string */
/* @var $currentPage integer */

use yii\helpers\Url;

?>

<?php if ($pageTitle): ?>
    <h1 class="mb-3"><?= $pageTitle ?></h1>
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