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
class Account extends \yii\db\ActiveRecord
{
    public $level = 0;

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
            return !(bool) $model->virtual;
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
        $this->virtual = (bool) $this->virtual;
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
    public function getParent() {
        return $this->hasOne(Account::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts() {
        return $this->hasMany(Account::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency() {
        return $this->hasOne(Currency::className(), ['id' => 'currency']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function forUser($userId) {
        return self::find()->where(["user_id" => $userId]);
    }

    private static function _buildHierarchy($item, $level = 0) {
        $model = $item['model'];
        $res = [$model->id => $model];
        $res[$model->id]->level = $level;
        if ($item['child']) {
            foreach ($item['child'] as $c) {
                $tree = self::_buildHierarchy($c, $level+1);
                foreach ($tree as $t) {
                    $res[$t->id] = $t;
                }
            }
        }
        return $res;
    }

    public static function hierarcyForUser($userId) {
        $result = array();
        $tree = array();
        $indexed = array();
        $models = self::forUser($userId)->all();
        $oldCount = null;
        $it = 0;
        while ($m = array_shift($models)) {
            $it++;
            if (0 && $it === 4) {
                \ddump($models, $indexed);
            }
            $item = ['model' => $m, 'child' => []];
            if (!$m->parent_id) {
                $tree[] = &$item;
            } elseif (!isset($indexed[$m->parent_id])) {
                array_push($models, $m);
                continue;
            } else {
                $indexed[$m->parent_id]['child'][$m->id] = &$item;
            }
            $indexed[$m->id] = &$item;
            unset($item);
//            \dump('', $indexed);
            $oldCount = count($models);
        }
        foreach ($tree as $t) {
            $hier = self::_buildHierarchy($t);
            foreach ($hier as $h) {
                $result[$h->id] = $h;
            }
        }
        return $result;
    }

    public function balance() {
        if ($this->virtual) {
            return null;
        }
        return -753.2;
    }

    public function renderBalance() {
        if ($this->virtual) {
            return "";
        }
        return sprintf($this->getCurrency()->one()->format, $this->balance());
    }

}
