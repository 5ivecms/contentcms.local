<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $settings array */

$this->title = 'Настройки для Cron';

?>

<div class="row">
    <div class="col-12 col-md-6">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Парсер keywords</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/cron') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.cron') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.cron') ?>
                <div class="form-group">
                    <?= $form->field($settings['cron.keywords.enabled'], "[cron.keywords.enabled]value")
                        ->checkbox(['label' => $settings['cron.keywords.enabled']['label']])
                    ?>
                    <?= $form->field($settings['cron.keywords.enabled'], "[cron.keywords.enabled]id")->hiddenInput()->label(false) ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <?= $form->field($settings['cron.keywords.limit'], "[cron.keywords.limit]value")
                                ->textInput(['type' => 'number'])
                                ->label($settings['cron.keywords.limit']['label'])
                            ?>
                            <?= $form->field($settings['cron.keywords.limit'], "[cron.keywords.limit]id")->hiddenInput()->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Команды для cron</h3>
            </div>
            <div class="card-body">
                <?php $directory = dirname(dirname(dirname(__DIR__))) ?>
                <b>1. Парсинг ключевых слов</b><br />
                <code>0 */8	* * * <?= $directory ?>\yii keyword/parse </code>
                <br />
                <br />
            </div>
        </div>
    </div>
</div>