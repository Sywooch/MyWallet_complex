<?php

namespace frontend\models;

use Yii;
use frontend\models\TransferAccount;
/**
 * This is the model class for table "transfer".
 *
 * @property integer $id
 * @property string $date
 * @property string $type
 * @property integer $source
 * @property string $out_sum
 * @property integer $dest
 * @property string $in_sum
 * @property string $ratio
 * @property string $comission
 * @property string $comment
 *
 * @property Account $dest0
 * @property Account $source0
 */
class Transfer extends \yii\db\ActiveRecord
{

    const TYPE_INCOMING = 'incoming';
    const TYPE_OUTGOING = 'outgoing';
    const TYPE_INTERNAL = 'internal';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'comment'], 'required'],
            [['date'], 'safe'],
            [['comission'], 'number'],
            [['comission'], 'default', 'value' => 0],
            [['comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('transfer', 'ID'),
            'date' => Yii::t('transfer', 'Date'),
            'source' => Yii::t('transfer', 'Source'),
            'out_sum' => Yii::t('transfer', 'Out Sum'),
            'dest' => Yii::t('transfer', 'Dest'),
            'in_sum' => Yii::t('transfer', 'In Sum'),
            'ratio' => Yii::t('transfer', 'Ratio'),
            'comission' => Yii::t('transfer', 'Comission'),
            'comment' => Yii::t('transfer', 'Comment'),
        ];
    }

    public function inAccounts() {
        return (new TransferAccount())->findAll(['transfer_id' => $this->id, 'type' => 'in']);
    }

    public function outAccounts() {
        return (new TransferAccount())->findAll(['transfer_id' => $this->id, 'type' => 'out']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDest0()
    {
        return $this->hasOne(Account::className(), ['id' => 'dest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(Account::className(), ['id' => 'source']);
    }
}
