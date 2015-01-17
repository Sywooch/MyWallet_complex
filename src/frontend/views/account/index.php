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
            ['class' => 'yii\grid\SerialColumn'],
            'title',
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
