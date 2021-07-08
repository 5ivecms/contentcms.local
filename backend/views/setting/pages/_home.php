<?php

use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $settings array */

$this->title = 'Главная страница';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['setting/pages']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
<?= Html::input('hidden', 'back_url', 'setting/page-home') ?>
<?= Html::input('hidden', 'cache_key', 'settings.homePage') ?>
<?= Html::input('hidden', 'cache_dependency', 'settings.homePage') ?>

    <div class="card">
        <div class="card-header bg-light">
            <h3 class="card-title" data-card-widget="collapse">Главная страница</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>SEO</h4>
                    <?= $form->field($settings['homePage.h1'], "[homePage.h1]value")
                        ->textInput(['type' => 'text'])
                        ->label($settings['homePage.h1']['label'])
                    ?>
                    <?= $form->field($settings['homePage.h1'], "[homePage.h1]id")->hiddenInput()->label(false) ?>

                    <?= $form->field($settings['homePage.metaTitle'], "[homePage.metaTitle]value")
                        ->textInput(['type' => 'text'])
                        ->label($settings['homePage.metaTitle']['label'])
                    ?>
                    <?= $form->field($settings['homePage.metaTitle'], "[homePage.metaTitle]id")->hiddenInput()->label(false) ?>

                    <?= $form->field($settings['homePage.metaDescription'], "[homePage.metaDescription]value")
                        ->textInput(['type' => 'text'])
                        ->label($settings['homePage.metaDescription']['label'])
                    ?>
                    <?= $form->field($settings['homePage.metaDescription'], "[homePage.metaDescription]id")->hiddenInput()->label(false) ?>
                </div>
                <div class="col-md-6">
                    <h4>Статьи</h4>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <?= $form->field($settings['homePage.articles.limit'], "[homePage.articles.limit]value")
                                ->textInput(['type' => 'number', 'min' => 0])
                                ->label($settings['homePage.articles.limit']['label'])
                            ?>
                            <?= $form->field($settings['homePage.articles.limit'], "[homePage.articles.limit]id")->hiddenInput()->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-4">Описания</h4>
            <div class="row">
                <div class="col-12 col-md-6">
                    <?= $form->field($settings['homePage.seoText1.show'], "[homePage.seoText1.show]value")
                        ->checkbox(['label' => $settings['homePage.seoText1.show']['label']])
                    ?>
                    <?= $form->field($settings['homePage.seoText1.show'], "[homePage.seoText1.show]id")->hiddenInput()->label(false) ?>

                    <?= $form->field($settings['homePage.seoText1.text'], '[homePage.seoText1.text]value')->widget(CKEditor::className(), [
                        'preset' => 'custom',
                        'clientOptions' => [
                            'height' => 200,
                            'toolbarGroups' => [
                                ['name' => 'basicstyles', 'groups' => ['basicstyles']],
                                ['name' => 'links', 'groups' => ['links']],
                                ['name' => 'paragraph', 'groups' => ['list', 'blocks']],
                                ['name' => 'document', 'groups' => ['mode']],
                                ['name' => 'insert', 'groups' => ['insert']],
                                ['name' => 'styles', 'groups' => ['styles']],
                                ['name' => 'about', 'groups' => ['about']],
                            ]
                        ]])->label($settings['homePage.seoText1.text']['label']) ?>
                    <?= $form->field($settings['homePage.seoText1.text'], "[homePage.seoText1.text]id")->hiddenInput()->label(false) ?>
                </div>
                <div class="col-12 col-md-6">
                    <?= $form->field($settings['homePage.seoText2.show'], "[homePage.seoText2.show]value")
                        ->checkbox(['label' => $settings['homePage.seoText2.show']['label']])
                    ?>
                    <?= $form->field($settings['homePage.seoText2.show'], "[homePage.seoText2.show]id")->hiddenInput()->label(false) ?>

                    <?= $form->field($settings['homePage.seoText2.text'], '[homePage.seoText2.text]value')->widget(CKEditor::className(), [
                        'preset' => 'custom',
                        'clientOptions' => [
                            'height' => 200,
                            'toolbarGroups' => [
                                ['name' => 'basicstyles', 'groups' => ['basicstyles']],
                                ['name' => 'links', 'groups' => ['links']],
                                ['name' => 'paragraph', 'groups' => ['list', 'blocks']],
                                ['name' => 'document', 'groups' => ['mode']],
                                ['name' => 'insert', 'groups' => ['insert']],
                                ['name' => 'styles', 'groups' => ['styles']],
                                ['name' => 'about', 'groups' => ['about']],
                            ]
                        ]])->label($settings['homePage.seoText2.text']['label']) ?>
                    <?= $form->field($settings['homePage.seoText2.text'], "[homePage.seoText2.text]id")->hiddenInput()->label(false) ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
<?php ActiveForm::end(); ?>