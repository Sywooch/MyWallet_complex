<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transfer */
switch ($model->type) {
    case 'incoming' :
        $this->title = 'Income';
        break;
    case 'internal':
        $this->title = 'Internal transaction';
        break;
    case 'outgoing':
        $this->title = 'Expense';
        break;
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('transfer', 'Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('transfer', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('transfer', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('transfer', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'comment:ntext',
        ],
    ])
    ?>
    <h2>Accounts</h2>
    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <?php foreach ($model->inAccounts() as $account) : ?>
            <tr>
                <th><?= $account->account->title; ?></th>
                <td><?= $account->type; ?></td>
                <td><?= $account->type == 'in' ? '' : '-'; ?><?= $account->account->formatSum($account->sum); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($model->outAccounts() as $account) : ?>
            <tr>
                <th><?= $account->account->title; ?></th>
                <td><?= $account->type; ?></td>
                <td><?= $account->type == 'in' ? '' : '-'; ?><?= $account->account->formatSum($account->sum); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
