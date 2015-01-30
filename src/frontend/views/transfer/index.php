<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('transfer', 'Transfers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('transfer', 'Create {modelClass}', [
    'modelClass' => 'Transfer',
]), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('transfer', 'New income'), ['createincome'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('transfer', 'New transfer'), ['createinternal'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'type',
//            'source',
//            'out_sum',
//            'dest',
            // 'in_sum',
            // 'ratio',
             'comission',
            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
