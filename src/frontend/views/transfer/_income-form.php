<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Account;
use frontend\models\TransferAccount;
/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comission')->textInput(['maxlength' => 10]) ?>

    <div class="account-in-wrapper">
        <h3>Accounts</h3>
        <a href="#" role="add-account">+ Add</a>
        <?php foreach ($inAccounts as $account) : ?>
        <div class="tranfer-account" id="transfer_account_<?=$account->id;?>">
            <?= $form->field($account, 'account_id')->dropDownList(Account::plainHierarcyForUser(Yii::$app->user->getId())); ?>
            <?= $form->field($account, 'sum')->textInput(['maxlength' => 10]) ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="tranfer-account in source">
        <?php
            $acc = new TransferAccount();
            $acc->type = 'in';
        ?>
        <?= $form->field($acc, 'account_id')->dropDownList(yii\helpers\ArrayHelper::merge(["" => ""], Account::plainHierarcyForUser(Yii::$app->user->getId()))); ?>
        <?= $form->field($acc, 'sum')->textInput(['maxlength' => 10]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('transfer', 'Create') : Yii::t('transfer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

?>
