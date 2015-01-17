<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Currency */

$this->title = Yii::t('currency', 'Update {modelClass}: ', [
    'modelClass' => 'Currency',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('currency', 'Update');
?>
<div class="currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
