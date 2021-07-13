<?php

/* @var $articles common\models\Article[] */

/* @var $pages array */
/* @var $pageTitle string */
/* @var $currentPage integer */

use yii\helpers\Url;

$placeholder = '/themes/' . \common\models\Themes::current() . '/assets/images/placeholder.jpg';
?>

<?php if ($pageTitle): ?>
    <header class="page-header">
        <h1 class="page-title"><?= $pageTitle ?></h1>
    </header>
<?php endif; ?>

<div class="posts-container posts-container--two-columns">
    <?php foreach ($articles as $article): ?>
        <article class="post-card post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="post-card__image">
                <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
                    <?php if ($article['thumb']): ?>
                        <img width="330" height="140"
                             src="<?= $article['thumb'] ?>"
                             class="attachment-thumb-wide size-thumb-wide wp-post-image"
                             alt="<?= $article['title'] ?>" loading="lazy" itemprop="image"
                        />
                    <?php else: ?>
                        <img
                                width="330"
                                height="140"
                                src="<?= $placeholder ?>"
                                class="attachment-thumb-wide size-thumb-wide wp-post-image"
                                alt="<?= $article['title'] ?>"
                                loading="lazy"
                                itemprop="image"
                        />
                    <?php endif; ?>
                </a>
            </div>
            <header class="entry-header">
                <div class="entry-title" itemprop="name">
                    <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>" rel="bookmark" itemprop="url">
                        <span itemprop="headline"><?= $article['title'] ?></span>
                    </a>
                </div>
            </header>
            <meta itemprop="author" content="Admin">
            <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                  itemid="<?= Yii::$app->request->hostInfo . Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>">
            <meta itemprop="dateModified" content="<?= date('Y-m-d', strtotime($article['updated_at'])) ?>">
            <meta itemprop="datePublished" content="<?= date('Y-m-d', strtotime($article['created_at'])) ?>">
        </article>
    <?php endforeach; ?>
</div>