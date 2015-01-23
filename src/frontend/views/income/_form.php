<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Account;
use yii\helpers\ArrayHelper;
use frontend\models\TransferAccount;
/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?php foreach ($accounts as $account) : ?>
        <?= $form->field($account, 'account_id')->dropDownList(ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>

        <?= $form->field($account, 'sum')->textInput(['maxlength' => 10]) ?>
    <?php endforeach; ?>
    <?php ob_start(); ?>
        <?= $form->field((new TransferAccount()), '[%transfer_id%]account_id')->dropDownList(ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>

        <?= $form->field((new TransferAccount()), '[%transfer_id%]sum')->textInput(['maxlength' => 10]) ?>
    <?php $group = ob_get_clean(); ?>

    <div class="accounts hide">
        <?= $group; ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('transfer', 'Create') : Yii::t('transfer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
