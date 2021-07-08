<?php

use yii\helpers\Url;

?>

<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Карта сайта</h3>
    </div>
    <div class="card-body">
        <a href="<?= Url::to(['setting/create-sitemap']) ?>" type="submit" class="btn btn-primary">Создать</a>
    </div>
</div>