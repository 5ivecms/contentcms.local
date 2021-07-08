<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Keyword */

$this->title = $model->keyword;
$this->params['breadcrumbs'][] = ['label' => 'Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

echo $this->render('_detailview', [
    'model' => $model,
    'mode' => DetailView::MODE_VIEW
]);