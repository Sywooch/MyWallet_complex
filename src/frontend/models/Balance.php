<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $date
 * @property string $sum
 */
class Balance extends \yii\db\ActiveRecord
{

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['insert'] = $scenarios['default'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'date'], 'required'],
            [['sum'], 'required', 'whenClient' => "function (attribute, value) {
                    return $('#currency').attr('checked');
                }"],
            [['account_id'], 'integer'],
            [['date'], 'safe'],
            [['sum'], 'number'],
            [['account_id', 'date'], 'unique', 'targetAttribute' => ['account_id', 'date'], 'message' => 'The combination of Account ID and Date has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('account', 'ID'),
            'account_id' => Yii::t('account', 'Account ID'),
            'date' => Yii::t('account', 'Date'),
            'sum' => Yii::t('account', 'Sum'),
        ];
    }
}
