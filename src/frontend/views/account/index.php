<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

use frontend\models\Account;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('currency', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('currency', 'Create {modelClass}', [
    'modelClass' => 'Account',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h2><?= Yii::t('account', 'Card accounts'); ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => Account::hierarcyForUser(Yii::$app->user->getId(), ['card']),
            'key' => 'id',
        ]),
        'columns' => [
            ['class' => 'frontend\widgets\grid\account\TitleColumn', 'header' => Yii::t('account', 'Title')],
            ['class' => 'frontend\widgets\grid\account\BalanceColumn', 'header' => Yii::t('account', 'Balance')],
//            'id',
//            'user_id',
            'type',
            'currency',

            // 'parent_id',
            // 'virtual',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <h2><?= Yii::t('account', 'Cash accounts'); ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => Account::hierarcyForUser(Yii::$app->user->getId(), ['money']),
            'key' => 'id',
        ]),
        'columns' => [
            ['class' => 'frontend\widgets\grid\account\TitleColumn', 'header' => Yii::t('account', 'Title')],
            ['class' => 'frontend\widgets\grid\account\BalanceColumn', 'header' => Yii::t('account', 'Balance')],
//            'id',
//            'user_id',
            'type',
            'currency',

            // 'parent_id',
            // 'virtual',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <h2><?= Yii::t('account', 'Credit cards'); ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => Account::hierarcyForUser(Yii::$app->user->getId(), ['creditcard']),
            'key' => 'id',
        ]),
        'columns' => [
            ['class' => 'frontend\widgets\grid\account\TitleColumn', 'header' => Yii::t('account', 'Title')],
            ['class' => 'frontend\widgets\grid\account\BalanceColumn', 'header' => Yii::t('account', 'Balance')],
//            'id',
//            'user_id',
            'type',
            'currency',

            // 'parent_id',
            // 'virtual',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
