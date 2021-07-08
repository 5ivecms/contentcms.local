<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="row">
        <div class="col-12 col-md-6">
            <?php $form = ActiveForm::begin(); ?>
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">Форма</h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'username')->textInput() ?>
                    <?= $form->field($model, 'password')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>
                <div class="card-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
