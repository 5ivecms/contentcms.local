<?php

/* @var $article common\models\Article */
/* @var $related common\models\Article[] */
/* @var $settings array */

use yii\helpers\Url;

$placeholder = '/themes/' . \common\models\Themes::current() . '/assets/images/placeholder.jpg';
?>

<div itemscope="" itemtype="http://schema.org/Article">
    <main id="main" class="site-main">
        <article class="post">
            <header class="entry-header">
                <h1 class="entry-title" itemprop="headline"><?= $article['title'] ?></h1>
            </header>
            <?php if ($settings['thumb.show']): ?>
                <?php if ($article['thumb']): ?>
                    <div class="entry-image">
                        <img
                                width="800"
                                height="522"
                                src="<?= $article['thumb']; ?>"
                                class="attachment-full size-full wp-post-image"
                                alt="<?= $article['title'] ?>"
                                loading="lazy"
                                itemprop="image"
                        />
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="entry-content" itemprop="articleBody">
                <?php if ($settings['tableContents.show'] && $article['table_contents']): ?>
                    <div id="toc_container" class="toc no_bullets">
                        <p class="toc__title">Содержание</p>
                        <?= $article['table_contents']; ?>
                    </div>
                <?php endif; ?>
                <?= htmlspecialchars_decode($article['text']) ?>
            </div>
        </article>

        <?php if ($related): ?>
            <div class="b-related">
                <?php if (!empty($settings['related.title'])): ?>
                    <div class="b-related__header">
                        <span><?= $settings['related.title'] ?></span>
                    </div>
                <?php endif; ?>
                <div class="b-related__items">
                    <?php foreach ($related as $article): ?>
                        <article class="post-card post">
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
                                <div class="entry-title">
                                    <a href="<?= Url::to(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]) ?>" rel="bookmark"><?= $article['title'] ?></a>
                                </div>
                            </header>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="https://winda10.com/drajvera-i-plaginy/otklyuchenie-proverki-podpisi-drayverov-windows-10.html">
        <meta itemprop="dateModified" content="2018-12-27">
        <meta itemprop="datePublished" content="2018-12-27T13:23:05+03:00">
    </main>
</div>
