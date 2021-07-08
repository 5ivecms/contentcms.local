<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Keyword */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keyword-form">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">Добавить списком</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['action' => ['create-list']]); ?>

                    <?= $form->field($model, 'list')->textarea(['placeholder' => 'Каждая фраза с новой строки', 'rows' => 10])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">Добавить</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

                    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true, 'placeholder' => 'Ключевая фраза'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
