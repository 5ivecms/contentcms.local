<?php

/* @var $articles common\models\Article[] */

/* @var $pages array */
/* @var $settings array */
/* @var $currentPage integer */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;

?>

<?php if ($settings['h1']): ?>
    <h1 class="mb-3"><?= $settings['h1'] ?></h1>
<?php endif; ?>

<?php if ($settings['seoText1.show'] && $currentPage < 2): ?>
    <?= $settings['seoText1.text'] ?>
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


<div class="clr clearfix">
    <?= LinkPager::widget([
        'pagination' => $pages,
        'nextPageLabel' => "<span aria-hidden=\"true\">&raquo;</span>\n<span class=\"sr-only\"></span>",
        'prevPageLabel' => "<span aria-hidden=\"true\">&laquo;</span>\n<span class=\"sr-only\"></span>"
    ]); ?>
</div>

<?php if ($settings['seoText2.show'] && $currentPage < 2): ?>
    <div class="site-desc site-desc-bottom clr clearfix">
        <?= $settings['seoText2.text'] ?>
    </div>
<?php endif; ?>
