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
                        <?php highlight_string('<?php use \common\widgets\PopularArticles\popularArticles; ?>'); ?>
                        <br/>
                        <?php highlight_string('<?= PopularArticles::widget() ?>'); ?>
                    </code>
                </div>

                <?= Html::input('hidden', 'back_url', 'setting/widget-popular-articles') ?>
                <?= Html::input('hidden', 'cache_key', 'widget.popularArticles') ?>
                <?= Html::input('hidden', 'cache_dependency', 'widget.popularArticles') ?>

                <div class="row mt-4">
                    <div class="col-6">
                        <?= $form->field($settings['widget.popularArticles.show'], "[widget.popularArticles.show]value")
                            ->checkbox(['label' => $settings['widget.popularArticles.show']['label']])
                        ?>
                        <?= $form->field($settings['widget.popularArticles.show'], "[widget.popularArticles.show]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['widget.popularArticles.title'], "[widget.popularArticles.title]value")
                            ->textInput(['type' => 'text', 'placeholder' => 'Заголовок'])
                            ->label($settings['widget.popularArticles.title']['label'])
                        ?>
                        <?= $form->field($settings['widget.popularArticles.title'], "[widget.popularArticles.title]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['widget.popularArticles.limit'], "[widget.popularArticles.limit]value")
                            ->textInput(['type' => 'number', 'placeholder' => 'Заголовок'])
                            ->label($settings['widget.popularArticles.limit']['label'])
                        ?>
                        <?= $form->field($settings['widget.popularArticles.limit'], "[widget.popularArticles.limit]id")->hiddenInput()->label(false) ?>
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