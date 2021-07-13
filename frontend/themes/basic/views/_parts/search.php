<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

?>

<div id="search-2" class="widget widget_search">
    <?= Html::beginForm([Url::to(['site/search'])], 'get', ['role' => 'search', 'enctype' => 'multipart/form-data', 'id' => 'searchform', 'class' => 'search-form']) ?>
    <?= Html::label('Поиск:', 's', ['class' => 'screen-reader-text']) ?>
    <?= Html::input('text', 'query', '', ['id' => 's', 'class' => 'search-form__text', 'placeholder' => 'Поиск']) ?>
    <?= Html::submitButton('', ['id' => 'searchsubmit', 'class' => 'search-form__submit']) ?>
    <?= Html::endForm() ?>
</div>