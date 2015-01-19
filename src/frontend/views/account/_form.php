<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Currency;
use frontend\models\Account;

/* @var $this yii\web\View */
/* @var $model frontend\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->scenario == 'insert') : ?>
        <?= $form->field($model, 'type')->dropDownList([ 'money' => 'Money', 'credit' => 'Credit', 'creditcard' => 'Creditcard', 'invest' => 'Invest', 'card' => 'Card', 'bonus' => 'Bonus'], ['prompt' => '']) ?>
        <?= $form->field($model, 'currency')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Currency::all())); ?>
    <?php else : ?>
        <?= $form->field($model, 'type')->textInput(['disabled' => 'true']);?>
        <?= $form->field($model, 'currency')->textInput(['disabled' => 'true']); ?>
    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'virtual')->checkbox(['1']); ?>

    <?php if ($model->scenario == 'insert') : ?>
        <?= $form->field($model, 'parent_id')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>
    <?php else: ?>
        <div class="form-group field-account-currency">
        <label class="control-label" for="account-currency">Parent</label>
        <div><?= $model->parent_id ?></div>

        <div class="help-block"></div>
        </div>
    <?php endif; ?>

    <?php if ($model->scenario == 'insert') : ?>
        <?= $form->field($balance, 'sum'); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('account', 'Create') : Yii::t('account', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
