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

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['insert'] = $scenarios['default'];
        return $scenarios;
    }

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

    public function formatSum($sum) {
        return sprintf($this->getCurrency()->one()->format, $sum);
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

    public static function forUser($userId, $types) {
        $condition = ["user_id" => $userId];
        if ($types) {
            $condition['type'] = $types;
        }
        return self::find()->where($condition);
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

    public static function hierarcyForUser($userId, $types = null) {
        $result = array();
        $tree = array();
        $indexed = array();
        $models = self::forUser($userId, $types)->all();
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

    public static function plainHierarcyForUser($userId, $types = null) {
        $result = array_map(function($item) {return str_pad("", $item->level, "-") . ' ' . $item->title;}, self::hierarcyForUser($userId, $types));
        return $result;
    }

    public function startBalance() {
        if ($this->virtual) {
            // TODO: Sum of children
            return null;
        }
        $balance = Balance::find()->where(['account_id' => $this->id])->orderBy(['date' => 'desc'])->limit(1)->one();
        if (is_null($balance)) {
            return 0;
        }
        // TODO: add date check and fix it if not found
        return (float)$balance->sum;
    }

    public function renderStartBalance() {
        if ($this->virtual) {
            return "";
        }
        return sprintf($this->getCurrency()->one()->format, $this->startBalance());
    }

}
