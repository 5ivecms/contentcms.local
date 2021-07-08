<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">Добавить</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Заголовок статьи']) ?>

                    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
                        'preset' => 'custom',
                        'clientOptions' => [
                            'height' => 500,
                            'toolbarGroups' => [
                                ['name' => 'basicstyles', 'groups' => ['basicstyles']],
                                ['name' => 'links', 'groups' => ['links']],
                                ['name' => 'paragraph', 'groups' => ['list', 'blocks']],
                                ['name' => 'document', 'groups' => ['mode']],
                                ['name' => 'insert', 'groups' => ['insert']],
                                ['name' => 'styles', 'groups' => ['styles']],
                                ['name' => 'about', 'groups' => ['about']],
                            ]
                        ]])->label('Текст статьи'); ?>

                    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true, 'placeholder' => 'Meta title']) ?>

                    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true, 'placeholder' => 'Meta description']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
