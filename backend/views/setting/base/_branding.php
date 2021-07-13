<?php

use kartik\form\ActiveForm;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;

/* @var $settings array */

?>

<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Брендирование сайта</h3>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <?= Html::input('hidden', 'back_url', 'setting/base') ?>
        <?= Html::input('hidden', 'cache_key', 'settings.branding') ?>
        <?= Html::input('hidden', 'cache_dependency', 'settings.branding') ?>

        <?= $form->field($settings['site.title'], "[site.title]value")
            ->textInput(['type' => 'text', 'placeholder' => 'Заголовок сайта'])
            ->label($settings['site.title']['label'])
        ?>
        <?= $form->field($settings['site.title'], "[site.title]id")->hiddenInput()->label(false) ?>

        <?= $form->field($settings['site.description'], "[site.description]value")
            ->textInput(['type' => 'text', 'placeholder' => 'Описание сайта'])
            ->label($settings['site.description']['label'])
        ?>
        <?= $form->field($settings['site.description'], "[site.description]id")->hiddenInput()->label(false) ?>

        <?= $form->field($settings['site.logo'], "[site.logo]value")->label($settings['site.logo']['label'])->widget(InputFile::className(), [
            'language'      => 'ru',
            'controller'    => 'elfinder',
            'filter'        => 'image',
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'multiple'      => false,
            'buttonName'    => 'Выбрать'
        ]); ?>
        <?= $form->field($settings['site.logo'], "[site.logo]id")->hiddenInput()->label(false) ?>

        <button type="submit" class="btn btn-primary">Сохранить</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>