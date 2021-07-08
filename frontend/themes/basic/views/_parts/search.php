<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<div class="navbar-search">
    <?= Html::beginForm([Url::to(['site/search'])], 'get', ['enctype' => 'multipart/form-data', 'class' => 'd-flex']) ?>
    <div class="input-group">
        <?= Html::input('text', 'query', '', ['class' => 'form-control', 'placeholder' => 'Поиск']) ?>
        <div class="input-group-append">
            <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
    <?= Html::endForm() ?>
</div>