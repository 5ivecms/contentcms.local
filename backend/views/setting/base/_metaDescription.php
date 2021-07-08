<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $settings array */

?>

<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Meta Description</h3>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <?= Html::input('hidden', 'back_url', 'setting/base') ?>
        <?= Html::input('hidden', 'cache_key', 'settings.metaDescription') ?>
        <?= Html::input('hidden', 'cache_dependency', 'settings.metaDescription') ?>

        <?= $form->field($settings['metaDescription.length'], "[metaDescription.length]value")
            ->textInput(['type' => 'number', 'min' => 0])
            ->label($settings['metaDescription.length']['label'])
        ?>
        <?= $form->field($settings['metaDescription.length'], "[metaDescription.length]id")->hiddenInput()->label(false) ?>

        <button type="submit" class="btn btn-primary">Сохранить</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>