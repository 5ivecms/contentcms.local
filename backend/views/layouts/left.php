<?php

/** @var \yii\web\View $this */
/** @var string $directoryAsset */

?>

<aside class="main-sidebar elevation-4 sidebar-light-navy">
    <?= \yii\helpers\Html::a('<img class="brand-image img-circle elevation-3" src="' . ($directoryAsset . '/img/AdminLTELogo.png') . '" alt="APP"><span class="brand-text font-weight-light">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'brand-link navbar-navy', 'style' => 'color: #fff;']) ?>
    <div class="sidebar">
        <nav class="mt-2">
            <?= dmstr\adminlte\widgets\Menu::widget(
                [
                    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget' => 'treeview'],
                    'items' => [
                        //['label' => 'Настройки', 'header' => true],
                        ['label' => 'Базовые', 'iconType' => 'fas', 'icon' => 'cog', 'url' => ['setting/base']],
                        ['label' => 'Парсер', 'iconType' => 'fas', 'icon' => 'cogs', 'url' => ['setting/parser']],
                        ['label' => 'Страницы', 'iconType' => 'far', 'icon' => 'file', 'url' => ['setting/pages']],
                        ['label' => 'Виджеты', 'iconType' => 'fas', 'icon' => 'icons', 'url' => ['setting/widgets']],
                        ['label' => 'Cron', 'iconType' => 'fas', 'icon' => 'globe', 'url' => ['setting/cron']],
                    ],
                ]
            ) ?>
        </nav>
    </div>
</aside>
