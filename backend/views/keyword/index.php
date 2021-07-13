<?php

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KeywordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ключевые фразы';
$this->params['breadcrumbs'][] = $this->title;

$selectedOptions = [
    Url::to(['keyword/parse-selected']) => 'Парсить выбранные',
    Url::to(['keyword/delete-selected']) => 'Удалить выбранные',
];

?>

<div class="keyword-index">

    <?= GridView::widget([
        'id' => 'keyword-gridview',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'rowSelectedClass' => GridView::BS_TABLE_INFO,
                'checkboxOptions' => function ($model) {
                    return ['value' => $model->id];
                },
            ],
            'id',
            'keyword',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_completed',
                'vAlign' => 'middle',
                'trueLabel' => 'Завршено',
                'falseLabel' => 'Не завршено',
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_failed',
                'vAlign' => 'middle',
                'trueLabel' => 'Ошибка',
                'falseLabel' => 'Без ошибки',
                'trueIcon' => '<span class="fas fa-times text-danger"></span>',
                'falseIcon' => '<span class="fas fa-check text-success"></span>',
            ],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
        'toolbar' => [
            [
                'content' =>
                    Html::a('<i class="fas fa-plus"></i>', ['create'], [
                        'class' => 'btn btn-success',
                        'title' => 'Добавить статьи'
                    ]) . ' ' .
                    Html::a('<i class="fas fa-redo"></i>', ['index'], [
                        'class' => 'btn btn-outline-secondary',
                        'title' => 'Обновить таблицу',
                        'data-pjax' => 1,
                    ]),
                'options' => ['class' => 'btn-group mr-2']
            ],
            '{export}',
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group'],
        'exportContainer' => ['class' => 'btn-group mr-2'],
        'responsive' => true,
        'panel' => [
            'heading' => '<h3 class="card-title">Список ключевых фраз</h3>',
            'type' => 'default',
            'after' => false,
            'before' =>
                '<div class="form-inline">' .
                Html::dropDownList('action', null, $selectedOptions, ['id' => 'action', 'class' => 'form-control mr-2']) .
                '<button id="actionBtn" type="submit" class="btn btn-primary mr-4">Выполнить</button>' .
                '</div>'
        ],
    ]); ?>

</div>

<?php
$js = <<< JS
$(document).on('click', '#actionBtn', function (event) {
    event.preventDefault();
    var actionBtn = $('#action');
    var ids = $('#keyword-gridview').yiiGridView('getSelectedRows');
    var action = actionBtn.val();
    var actionText = actionBtn.find('option:selected').text();

    if (confirm('Точно ' + actionText + '?')) {
        $.ajax({
            type: 'POST',
            url: action,
            data: {ids: ids},
            dataType: 'JSON',
            success: function (resp) {
                if (resp.success) {
                    alert(resp.msg);
                }
                location.reload();
            }
        });
    }
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);