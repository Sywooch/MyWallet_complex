<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */

$this->title = Yii::t('transfer', 'Create {modelClass}', [
    'modelClass' => 'Transfer',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('transfer', 'Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'inAccounts' => $inAccounts,
        'outAccounts' => $outAccounts,
    ]) ?>

</div>
