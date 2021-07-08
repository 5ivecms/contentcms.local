<?php

/* @var $cacheSettings array */
/* @var $themeSettings array */
/* @var $shortTextSettings array */
/* @var $metaDescriptionSettings array */

$this->title = 'Базовые настройки';

?>

<div class="row">
    <div class="col-12 col-md-6">
        <?= $this->render('base/_theme', ['settings' => $themeSettings]) ?>
        <?= $this->render('base/_sitemap') ?>
        <?= $this->render('base/_shortText', ['settings' => $shortTextSettings]) ?>
        <?= $this->render('base/_metaDescription', ['settings' => $metaDescriptionSettings]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= $this->render('base/_cache', ['settings' => $cacheSettings]);?>
    </div>
</div>