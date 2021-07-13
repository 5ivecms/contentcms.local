<?php

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

$this->title = 'Страницы';

$this->params['breadcrumbs'][] = $this->title;

$pages = [
    [
        'title' => 'Главная',
        'url' => Url::to(['setting/page-home'])
    ],
    [
        'title' => 'Каталог статей',
        'url' => Url::to(['setting/page-articles-catalog'])
    ],
    [
        'title' => 'Статья',
        'url' => Url::to(['setting/page-article'])
    ],
    [
        'title' => 'Правообладателям',
        'url' => Url::to(['setting/page-dmca'])
    ],
    [
        'title' => 'Политика конфиденциальности',
        'url' => Url::to(['setting/page-privacy'])
    ],
];

$provider = new ArrayDataProvider([
    'allModels' => $pages,
]);

?>

<?= GridView::widget([
    'id' => 'pages',
    'dataProvider' => $provider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
        'style' => 'margin:0;'
    ],
    'showPageSummary' => false,
    'columns' => [
        ['class' => '\kartik\grid\SerialColumn'],
        [
            'attribute' => 'title',
            'label' => 'Страница',
            'format' => 'raw',
            'value' => function ($model) {
                return '<a href="' . $model['url'] . '">' . $model['title'] . '</a>';
            }
        ],
        [
            'attribute' => 'edit',
            'label' => '',
            'width' => '100px',
            'format' => 'raw',
            'value' => function ($model) {
                return '<a href="' . $model['url'] . '" class="btn btn-sm btn-primary">Редактировать</a>';
            }
        ],
    ],
    'toolbar' => false,
    'responsive' => false,
    'panelTemplate' => '{panelHeading}{panelBefore}{items}{panelAfter}',
    'panelHeadingTemplate' => '{title}<div class="clearfix"></div>',
    'panel' => [
        'heading' => '<h3 class="card-title">Список страниц</h3>',
        'type' => 'default',
        'after' => false,
        'before' => false
    ],
]); ?>