<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $settings array */
/* @var $contentApiSettings array */

$this->title = 'Настройки парсинга';

$modes = [
    1 => 'Режим 1',
    2 => 'Режим 2',
    3 => 'Режим 3',
    4 => 'Режим 4',
    5 => 'Режим 5'
];
?>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Контент API</h3>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'contentApi.host') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.contentApi') ?>

                <?= $form->field($contentApiSettings['contentApi.host'], "[contentApi.host]value")
                    ->textarea(['type' => 'text', 'placeholder' => 'https://site.ru', 'rows' => 5])
                    ->label($contentApiSettings['contentApi.host']['label'])
                ?>
                <?= $form->field($contentApiSettings['contentApi.host'], "[contentApi.host]id")->hiddenInput()->label(false) ?>

                <?= $form->field($contentApiSettings['contentApi.token'], "[contentApi.token]value")
                    ->textInput(['type' => 'text', 'placeholder' => ''])
                    ->label($contentApiSettings['contentApi.token']['label'])
                ?>
                <?= $form->field($contentApiSettings['contentApi.token'], "[contentApi.token]id")->hiddenInput()->label(false) ?>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим работы</h3>
            </div>
            <div class="card-body">
                <p><b>Режим 5</b> является самым оптимальным режимом работы.</p>
                <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser') ?>
                <div class="row">
                    <div class="col-12 col-md-9">
                        <?= $form->field($settings['articleParser.mode'], "[articleParser.mode]value")->dropDownList($modes)->label(false); ?>
                        <?= $form->field($settings['articleParser.mode'], "[articleParser.mode]id")->hiddenInput()->label(false) ?>
                    </div>
                    <div class="col-12 col-md-3">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим 1</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser.mode1') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser.mode1') ?>
                <p>В этом режиме работы статьи соединяются последовательно</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $form->field($settings['articleParser.mode1.articlesLimit'], "[articleParser.mode1.articlesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode1.articlesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode1.articlesLimit'], "[articleParser.mode1.articlesLimit]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode1.startPage'], "[articleParser.mode1.startPage]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode1.startPage']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode1.startPage'], "[articleParser.mode1.startPage]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode1.pagesLimit'], "[articleParser.mode1.pagesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode1.pagesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode1.pagesLimit'], "[articleParser.mode1.pagesLimit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим 2</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser.mode2') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser.mode2') ?>
                <p>В этом режиме работы <b>ВСЕ</b> части статей перемешиваются случайным образом. Первая часть берется берется из случайной статьи.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $form->field($settings['articleParser.mode2.articlesLimit'], "[articleParser.mode2.articlesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode2.articlesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode2.articlesLimit'], "[articleParser.mode2.articlesLimit]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode2.startPage'], "[articleParser.mode2.startPage]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode2.startPage']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode2.startPage'], "[articleParser.mode2.startPage]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode2.pagesLimit'], "[articleParser.mode2.pagesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode2.pagesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode2.pagesLimit'], "[articleParser.mode2.pagesLimit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-12 col-md-6">
        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим 3</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser.mode3') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser.mode3') ?>
                <p>В этом режиме работы собирается определенное количество статей. <b>ЧАСТИ СТАТЕЙ</b> перемешиваются <b>СЛУЧАЙНЫМ</b> образом и затем выбирается определенное количество <b>ЧАСТЕЙ</b>. Первая часть берется из случайной статьи.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $form->field($settings['articleParser.mode3.articlesLimit'], "[articleParser.mode3.articlesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode3.articlesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode3.articlesLimit'], "[articleParser.mode3.articlesLimit]id")
                            ->hiddenInput()
                            ->label(false) ?>

                        <?= $form->field($settings['articleParser.mode3.chunksLimit'], "[articleParser.mode3.chunksLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode3.chunksLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode3.chunksLimit'], "[articleParser.mode3.chunksLimit]id")
                            ->hiddenInput()
                            ->label(false) ?>

                        <?= $form->field($settings['articleParser.mode3.startPage'], "[articleParser.mode3.startPage]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode3.startPage']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode3.startPage'], "[articleParser.mode3.startPage]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode3.pagesLimit'], "[articleParser.mode3.pagesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode3.pagesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode3.pagesLimit'], "[articleParser.mode3.pagesLimit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим 4</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser.mode4') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser.mode4') ?>
                <p>В этом режиме работы из каждой статьи случайным образом выбирается <b>ПО ОДНОЙ</b> части. Первая часть берется из случайной статьи.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $form->field($settings['articleParser.mode4.articlesLimit'], "[articleParser.mode4.articlesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode4.articlesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode4.articlesLimit'], "[articleParser.mode4.articlesLimit]id")
                            ->hiddenInput()
                            ->label(false) ?>

                        <?= $form->field($settings['articleParser.mode4.startPage'], "[articleParser.mode4.startPage]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode4.startPage']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode4.startPage'], "[articleParser.mode4.startPage]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode4.pagesLimit'], "[articleParser.mode4.pagesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode4.pagesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode4.pagesLimit'], "[articleParser.mode4.pagesLimit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

        <?php $form = ActiveForm::begin(['action' => '/admin/setting/update']); ?>
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title">Режим 5</h3>
            </div>
            <div class="card-body">
                <?= Html::input('hidden', 'back_url', 'setting/parser') ?>
                <?= Html::input('hidden', 'cache_key', 'settings.articleParser.mode5') ?>
                <?= Html::input('hidden', 'cache_dependency', 'settings.articleParser.mode5') ?>
                <p>В этом режиме работы собранные статьи деляться на части по заголовку h2. Затем полученные части соединяются последовательно в том же порядке, как и у исходных статей.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $form->field($settings['articleParser.mode5.articlesLimit'], "[articleParser.mode5.articlesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode5.articlesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode5.articlesLimit'], "[articleParser.mode5.articlesLimit]id")
                            ->hiddenInput()
                            ->label(false) ?>

                        <?= $form->field($settings['articleParser.mode5.startPage'], "[articleParser.mode5.startPage]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode5.startPage']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode5.startPage'], "[articleParser.mode5.startPage]id")->hiddenInput()->label(false) ?>

                        <?= $form->field($settings['articleParser.mode5.pagesLimit'], "[articleParser.mode5.pagesLimit]value")
                            ->textInput(['type' => 'number', 'min' => 1])
                            ->label($settings['articleParser.mode5.pagesLimit']['label'])
                        ?>
                        <?= $form->field($settings['articleParser.mode5.pagesLimit'], "[articleParser.mode5.pagesLimit]id")->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
