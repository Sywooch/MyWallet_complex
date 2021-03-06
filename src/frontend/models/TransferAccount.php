<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transfer_account".
 *
 * @property integer $id
 * @property integer $transfer_id
 * @property integer $account_id
 * @property string $in
 * @property string $sum
 * @property string $description
 *
 * @property Transfer $transfer
 * @property Account $account
 */
class TransferAccount extends \yii\db\ActiveRecord
{
    public function formName() {
        $name = parent::formName();
        $name .= "_" . $this->type;
        if (!$this->id) {
            $name .= "_newtransferaccount";
        } else {
            $name .= "_" . $this->id;
        }
        return $name;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfer_id', 'account_id', 'sum'], 'required'],
            [['transfer_id', 'account_id'], 'integer'],
            [['type'], 'safe'],
            [['sum'], 'number'],
            [['description'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('transfer', 'ID'),
            'transfer_id' => Yii::t('transfer', 'Transfer ID'),
            'account_id' => Yii::t('transfer', 'Account ID'),
            'type' => Yii::t('transfer', 'Type'),
            'sum' => Yii::t('transfer', 'Sum'),
            'description' => Yii::t('transfer', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfer()
    {
        return $this->hasOne(Transfer::className(), ['id' => 'transfer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}
