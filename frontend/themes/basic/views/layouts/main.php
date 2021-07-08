<?php

/* @var $this yii\web\View */
/* @var $content string */

use frontend\themes\basic\ThemeAsset;


use frontend\widgets\LastArticles\LastArticles;
use frontend\widgets\PopularArticles\PopularArticles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

ThemeAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>">Контент</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['article/index']) ?>">Все статьи</a>
                </li>
            </ul>
            <?= $this->render('../_parts/search') ?>
        </div>
    </div>
</nav>

<main class="main my-5">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="row">
            <div class="col-md-9">
                <?= $content ?>
            </div>
            <div class="col-md-3">
                <?= PopularArticles::widget() ?>
                <?= LastArticles::widget() ?>
            </div>
        </div>
    </div>
</main>

<footer class="footer bg-dark text-white">
    <div class="container">
        DarkTube.com - Интересные видео на каждый день
        <div class="ft-copyr">Все права серьезно защищены © <?= date('Y') ?>.</div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
