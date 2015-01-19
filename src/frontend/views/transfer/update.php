<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */

$this->title = Yii::t('transfer', 'Update {modelClass}: ', [
    'modelClass' => 'Transfer',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('transfer', 'Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('transfer', 'Update');
?>
<div class="transfer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
