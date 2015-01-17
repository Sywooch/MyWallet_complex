<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Currency;

/* @var $this yii\web\View */
/* @var $model frontend\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'income' => 'Income', 'expense' => 'Expense', 'money' => 'Money', 'credit' => 'Credit', 'creditcard' => 'Creditcard', 'invest' => 'Invest', 'card' => 'Card', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'currency')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Currency::all())); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'virtual')->checkbox(['1']); ?>

    <?= $form->field($model, 'parent_id')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('account', 'Create') : Yii::t('account', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
