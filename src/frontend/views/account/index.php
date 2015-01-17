<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
