<?php

namespace api\modules\v1\controllers;

use common\models\Setting;
use yii\data\ActiveDataProvider;

class SettingController extends BaseActiveController
{
    public $modelClass = 'common\models\Setting';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Setting::find(),
            'pagination' => false,
        ]);
    }
}