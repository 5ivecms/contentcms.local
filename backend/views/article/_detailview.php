<?php

use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $model common\models\Article */
/* @var $mode string */

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'slug',
        'title',
        [
            'columns' => [
                [
                    'attribute' => 'text',
                    'label' => 'Текст статьи',
                    'format' => 'raw',
                    'type' => 'widget',
                    'widgetOptions' => [
                        'class' => \dosamigos\ckeditor\CKEditor::className(),
                        'preset' => 'custom',
                        'clientOptions' => [
                            'height' => 700,
                            'toolbarGroups' => [
                                ['name' => 'basicstyles', 'groups' => ['basicstyles']],
                                ['name' => 'links', 'groups' => ['links']],
                                ['name' => 'paragraph', 'groups' => ['list', 'blocks']],
                                ['name' => 'document', 'groups' => ['mode']],
                                ['name' => 'insert', 'groups' => ['insert']],
                                ['name' => 'styles', 'groups' => ['styles']],
                                ['name' => 'about', 'groups' => ['about']],
                            ]
                        ]
                    ],
                    'valueColOptions' => ['style' => 'width:80%']
                ]
            ],
        ],
        'meta_title',
        'meta_description',
    ],
    'striped' => false,
    'fadeDelay' => 100,
    'panel' => [
        'heading' => '<h3 class="card-title">Информация о статье</h3>',
        'type' => DetailView::TYPE_DEFAULT,
    ],
    'vAlign' => DetailView::ALIGN_TOP,
    'formOptions' => ['action' => Url::to(['update', 'id' => $model->id])],
    'deleteOptions' => ['url' => Url::to(['delete', 'id' => $model->id])],
    'mode' => $mode
]);
