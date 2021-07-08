<?php

/* @var $this yii\web\View */
/* @var $model common\models\Keyword */

$this->title = 'Добавить ключевые фразы';
$this->params['breadcrumbs'][] = ['label' => 'Ключевые фразы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="keyword-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
