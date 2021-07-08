<?php

use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

/* @var $settings array */

$this->title = 'Последние статьи';
$this->params['breadcrumbs'][] = ['label' => 'Виджеты', 'url' => ['setting/widgets']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-12 col-md-6">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Настройки</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <code>
                        <b>Использование:</b>
                        <br/>
                        <?php highlight_string('<?php use \common\widgets\LastArticles\LastArticles; ?>'); ?>
                        <br/>
                        <?php highlight_string('<?= LastArticles::widget() ?>'); ?>
                    </code>
                </div>

                <?= Html::input('hidden', 'back_url', 'setting/widget-last-articles') ?>
                <?= Html::input('hidden', 'cache_key', 'widget.lastArticles') ?>
                <?= Html::input('hidden', 'cache_dependency', 'widget.lastArticles') ?>

                <div class="row mt-4">
                    <div class="col-6">
                        <?= $form->field($settings['widget.lastArticles.show'], "[widget.lastArticles.show]value")
                            ->checkbox(['label' => $settings['widget.lastArticles.show']['label']])
                        ?>
                        <?= $form->field($settings['widget.lastArticles.show'], "[widget.lastArticles.show]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['widget.lastArticles.title'], "[widget.lastArticles.title]value")
                            ->textInput(['type' => 'text', 'placeholder' => 'Заголовок'])
                            ->label($settings['widget.lastArticles.title']['label'])
                        ?>
                        <?= $form->field($settings['widget.lastArticles.title'], "[widget.lastArticles.title]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['widget.lastArticles.limit'], "[widget.lastArticles.limit]value")
                            ->textInput(['type' => 'number', 'placeholder' => 'Заголовок'])
                            ->label($settings['widget.lastArticles.limit']['label'])
                        ?>
                        <?= $form->field($settings['widget.lastArticles.limit'], "[widget.lastArticles.limit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>