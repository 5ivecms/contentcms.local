<?php

use common\models\Themes;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

/* @var $settings array */

?>

<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Тема</h3>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <?= Html::input('hidden', 'back_url', 'setting/base') ?>
        <?= Html::input('hidden', 'cache_key', 'themes.theme') ?>

        <?= $form->field($settings['themes.theme'], "[themes.theme]value")
            ->widget(Select2::classname(), [
                'data' => Themes::themesList(),
                'options' => ['placeholder' => 'Выберите тему'],
            ])
            ->label($settings['themes.theme']['label']);
        ?>
        <?= $form->field($settings['themes.theme'], "[themes.theme]id")->hiddenInput()->label(false) ?>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php ActiveForm::end(); ?>
    </div>
</div>