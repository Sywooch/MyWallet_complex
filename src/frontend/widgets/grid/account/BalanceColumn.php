<?php

namespace frontend\widgets\grid\account;

use \yii\grid\Column;
use \yii\helpers\Html;

class BalanceColumn extends Column {

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index) {
        if (is_null($model->balance())) {
            return;
        }
        $divAttr = "";
        if ($model->balance() <= 0) {
            $divAttr .= ' class="sum-negative"';
        }
        return '<div'. $divAttr .'>'
                . $model->renderBalance()
                . '</div>';
    }

}
