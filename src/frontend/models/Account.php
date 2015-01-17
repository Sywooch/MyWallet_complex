<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $currency
 * @property string $title
 * @property integer $parent_id
 */
class Account extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'title'], 'required'],
            [['parent_id'], 'integer'],
            [['type'], 'string'],
            [['currency'], 'required', 'when' => function($model) {
                return ! (bool) $model->virtual;
            }, 'whenClient' => "function (attribute, value) {
                return $('#currency').attr('checked');
            }"],
            [['title'], 'string', 'max' => 255],
            [['virtual'], 'default', 'value' => 0],
        ];
    }

    public function beforeSave($insert) {
        if ($insert) {
            $this->user_id = \Yii::$app->user->id;
        }
        if ($this->virtual) {
            $this->currency = null;
        }
        $this->virtual = (bool)$this->virtual;
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('currency', 'ID'),
            'user_id' => Yii::t('currency', 'User ID'),
            'type' => Yii::t('currency', 'Type'),
            'currency' => Yii::t('currency', 'Currency'),
            'title' => Yii::t('currency', 'Title'),
            'parent_id' => Yii::t('currency', 'Parent ID'),
            'virtual' => Yii::t('currency', 'Virtual'),
        ];
    }



   /**
    * @return \yii\db\ActiveQuery
    */
   public function getParent()
   {
       return $this->hasOne(Account::className(), ['id' => 'parent_id']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getAccounts()
   {
       return $this->hasMany(Account::className(), ['parent_id' => 'id']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getCurrency0()
   {
       return $this->hasOne(Currency::className(), ['id' => 'currency']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getUser()
   {
       return $this->hasOne(User::className(), ['id' => 'user_id']);
   }

}
