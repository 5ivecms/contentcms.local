<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $settings array */

?>

<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Короткое описание</h3>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <?= Html::input('hidden', 'back_url', 'setting/base') ?>
        <?= Html::input('hidden', 'cache_key', 'settings.shortText') ?>
        <?= Html::input('hidden', 'cache_dependency', 'settings.shortText') ?>

        <?= $form->field($settings['shortText.length'], "[shortText.length]value")
            ->textInput(['type' => 'number', 'min' => 0])
            ->label($settings['shortText.length']['label'])
        ?>
        <?= $form->field($settings['shortText.length'], "[shortText.length]id")->hiddenInput()->label(false) ?>

        <button type="submit" class="btn btn-primary">Сохранить</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>