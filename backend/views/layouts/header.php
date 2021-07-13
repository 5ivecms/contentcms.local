<?php

/** @var \yii\web\View $this */
/** @var string $directoryAsset */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/article/index" class="nav-link">Статьи</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/keyword/index" class="nav-link">Ключевые фразы</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="/admin/user/index">Пользователи</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="<?= Yii::$app->urlManagerFrontEnd->createUrl(['/site/index']) ?>" target="_blank" class="nav-link" title="Сайт">
                <i class="nav-icon fas fa-globe mr-1"></i>
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline"><i class="fas fa-user mr-1"></i></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-footer"><?= Yii::$app->user->identity->username ?></li>
                <li class="user-footer">
                    <?= Html::a(
                        'Sign out',
                        ['site/logout'],
                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat float-right']
                    ) ?>
                </li>
            </ul>
        </li>
    </ul>
</nav>
