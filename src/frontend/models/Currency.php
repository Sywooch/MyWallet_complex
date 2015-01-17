<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property string $id
 * @property string $title
 * @property string $format
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'format'], 'required'],
            [['id'], 'string', 'max' => 5],
            [['title'], 'string', 'max' => 64],
            [['format'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('currency', 'ID'),
            'title' => Yii::t('currency', 'Title'),
            'format' => Yii::t('currency', 'Format'),
        ];
    }

    public static function all() {
        $currencies = self::find()->all();
        $result = [];
        foreach ($currencies as $c) {
            $result[$c->id] = $c->title;
        }
        return $result;
    }
}
