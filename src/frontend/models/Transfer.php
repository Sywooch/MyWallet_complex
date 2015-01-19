<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property integer $id
 * @property string $date
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
            [['date', 'source', 'out_sum', 'dest', 'in_sum', 'ratio', 'comission', 'comment'], 'required'],
            [['date'], 'safe'],
            [['source', 'dest'], 'integer'],
            [['out_sum', 'in_sum', 'ratio', 'comission'], 'number'],
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
