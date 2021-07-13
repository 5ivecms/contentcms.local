<?php

use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $settings array */

$this->title = 'Политика конфиденциальности';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['setting/pages']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
<?= Html::input('hidden', 'back_url', 'setting/page-privacy') ?>
<?= Html::input('hidden', 'cache_key', 'settings.privacy') ?>
<?= Html::input('hidden', 'cache_dependency', 'settings.privacy') ?>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title" data-card-widget="collapse">Настройки</h3>
                </div>
                <div class="card-body">
                    <?= $form->field($settings['page.privacy.metaTitle'], "[page.privacy.metaTitle]value")
                        ->textInput(['type' => 'text'])
                        ->label($settings['page.privacy.metaTitle']['label'])
                    ?>
                    <?= $form->field($settings['page.privacy.metaTitle'], "[page.privacy.metaTitle]id")->hiddenInput()->label(false) ?>

                    <?= $form->field($settings['page.privacy.metaDescription'], "[page.privacy.metaDescription]value")
                        ->textInput(['type' => 'text'])
                        ->label($settings['page.privacy.metaDescription']['label'])
                    ?>
                    <?= $form->field($settings['page.privacy.metaDescription'], "[page.privacy.metaDescription]id")->hiddenInput()->label(false) ?>


                    <?= $form->field($settings['page.privacy.text'], '[page.privacy.text]value')->widget(CKEditor::className(), [
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
                        ]])->label($settings['page.privacy.text']['label']) ?>
                    <?= $form->field($settings['page.privacy.text'], "[page.privacy.text]id")->hiddenInput()->label(false) ?>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>