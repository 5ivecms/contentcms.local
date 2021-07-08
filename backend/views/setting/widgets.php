<?php

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

$this->title = 'Виджеты';

$this->params['breadcrumbs'][] = $this->title;

$widgets = [
    [
        'title' => 'Последние статьи',
        'url' => Url::to(['setting/widget-last-articles'])
    ],
    [
        'title' => 'Популярные статьи',
        'url' => Url::to(['setting/widget-popular-articles'])
    ],
];

$provider = new ArrayDataProvider([
    'allModels' => $widgets,
]);

?>


<?= GridView::widget([
    'id' => 'widgets',
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
        'heading' => '<h3 class="card-title">Список виджетов</h3>',
        'type' => 'default',
        'after' => false,
        'before' => false
    ],
]); ?>
