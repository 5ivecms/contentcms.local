<?php

/* @var $articles common\models\Article[] */

/* @var $pages array */
/* @var $settings array */
/* @var $currentPage integer */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;

?>

<?php if ($settings['h1']): ?>
    <header class="page-header">
        <h1 class="page-title"><?= $settings['h1'] ?></h1>
    </header>
<?php endif; ?>

<?php if ($settings['seoText1.show'] && $currentPage < 2): ?>
    <?= $settings['seoText1.text'] ?>
<?php endif; ?>

<div class="posts-container">
    <?php foreach ($articles as $article): ?>
        <article class="post-box" itemscope="" itemtype="http://schema.org/BlogPosting">
            <header class="entry-header">
                <div class="entry-title" itemprop="name">
                    <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>" rel="bookmark" itemprop="url">
                        <span itemprop="headline"><?= $article['title'] ?></span>
                    </a>
                </div>
            </header>
            <div class="entry-image">
                <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
                    <?php if ($article['thumb']): ?>
                    <img
                            width="770"
                            height="330"
                            src="<?= $article['thumb'] ?>"
                            class="attachment-thumb-big size-thumb-big wp-post-image"
                            alt="<?= $article['title'] ?>"
                            loading="lazy"
                            itemprop="image"
                    />
                    <?php endif; ?>
                </a>
            </div>
            <div class="post-box__content" itemprop="articleBody">
                <p><?= $article['short_text'] ?></p>
            </div>
            <footer class="post-box__footer">
                <a href="<?=  Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>" class="entry-footer__more">Читать полностью</a>
            </footer>
            <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="<?= Yii::$app->request->hostInfo . Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
            <meta itemprop="dateModified" content="2018-12-25">
        </article>
    <?php endforeach; ?>
</div>

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
