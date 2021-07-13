<?php

/* @var $settings array */

use yii\helpers\Url;

?>

<main id="main" class="site-main" itemscope="" itemtype="http://schema.org/Article">
    <article class="page">
        <?php if ($settings['metaTitle']): ?>
            <header class="entry-header">
                <h1 class="entry-title" itemprop="headline"><?= $settings['metaTitle'] ?></h1>
            </header>
        <?php endif; ?>
        <div class="page-separator"></div>
        <div class="entry-content" itemprop="articleBody">
            <?= $settings['text'] ?>
        </div>
    </article>
    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
          itemid="<?= Yii::$app->request->hostInfo . Url::to(['site/privacy']) ?>">
    <meta itemprop="dateModified" content="2019-10-02">
    <meta itemprop="datePublished" content="2019-10-02T18:49:58+03:00">
    <meta itemprop="author" content="Admin">
</main>
