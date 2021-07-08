<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p class="text-right">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'created_at',
            'updated_at',
            'access_token',
        ],
        'striped' => false,
        'fadeDelay' => 100,
        'panel' => [
            'heading' => '<h3 class="card-title">Информация о видео</h3>',
            'type' => DetailView::TYPE_DEFAULT,
        ],
        'vAlign' => DetailView::ALIGN_TOP,
        'enableEditMode' => false,
        'mode' => DetailView::MODE_VIEW
    ]) ?>

</div>
