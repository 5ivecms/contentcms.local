<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $settings array */

$this->title = 'Статья';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['setting/pages']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
<?= Html::input('hidden', 'back_url', 'setting/page-article') ?>
<?= Html::input('hidden', 'cache_key', 'settings.article') ?>
<?= Html::input('hidden', 'cache_dependency', 'settings.article') ?>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title" data-card-widget="collapse">Настройки</h3>
                </div>
                <div class="card-body">
                    <h4>Похожие статьи</h4>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <?= $form->field($settings['article.related.title'], "[article.related.title]value")
                                ->textInput(['type' => 'text'])
                                ->label($settings['article.related.title']['label'])
                            ?>
                            <?= $form->field($settings['article.related.title'], "[article.related.title]id")->hiddenInput()->label(false) ?>

                            <?= $form->field($settings['article.related.limit'], "[article.related.limit]value")
                                ->textInput(['type' => 'number', 'min' => 0])
                                ->label($settings['article.related.limit']['label'])
                            ?>
                            <?= $form->field($settings['article.related.limit'], "[article.related.limit]id")->hiddenInput()->label(false) ?>
                        </div>
                    </div>

                    <h4 class="mt-4">Превью</h4>
                    <?= $form->field($settings['article.thumb.show'], "[article.thumb.show]value")
                        ->checkbox(['label' => $settings['article.thumb.show']['label']])
                    ?>
                    <?= $form->field($settings['article.thumb.show'], "[article.thumb.show]id")->hiddenInput()->label(false) ?>

                    <h4 class="mt-4">Оглавление</h4>
                    <?= $form->field($settings['article.tableContents.show'], "[article.tableContents.show]value")
                        ->checkbox(['label' => $settings['article.tableContents.show']['label']])
                    ?>
                    <?= $form->field($settings['article.tableContents.show'], "[article.tableContents.show]id")->hiddenInput()->label(false) ?>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>