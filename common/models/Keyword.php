<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property int $id
 * @property string|null $keyword
 * @property int|null $is_completed
 * @property int|null $is_failed
 *
 * @property array $list
 */
class Keyword extends \yii\db\ActiveRecord
{
    const IS_COMPLETED_STATUS = 1;
    const IS_NOT_COMPLETED_STATUS = 0;
    const IS_FAILED_STATUS = 1;
    const IS_NOT_FAILED_STATUS = 0;

    public $list;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_completed', 'is_failed'], 'integer'],
            [['keyword'], 'string', 'max' => 255],
            [['keyword'], 'unique'],
            [['list'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Ключевая фраза',
            'is_completed' => 'Завершено',
            'is_failed' => 'Ошибка'
        ];
    }
}
