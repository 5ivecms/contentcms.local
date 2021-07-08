<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Keyword */

$this->title = 'Редактировать: ' . $model->keyword;
$this->params['breadcrumbs'][] = ['label' => 'Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keyword, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';

echo $this->render('_detailview', [
    'model' => $model,
    'mode' => DetailView::MODE_EDIT
]);