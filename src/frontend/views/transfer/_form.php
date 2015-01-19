<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Account;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'source')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>

    <?= $form->field($model, 'out_sum')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'dest')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>

    <?= $form->field($model, 'in_sum')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'ratio')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'comission')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('transfer', 'Create') : Yii::t('transfer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
