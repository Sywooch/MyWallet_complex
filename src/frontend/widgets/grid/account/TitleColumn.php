<?php

namespace frontend\widgets\grid\account;

use \yii\grid\Column;
use \yii\helpers\Html;

class TitleColumn extends Column {

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index) {
        return '<div style="padding-left: ' . ($model->level * 20) . 'px;">'
                . Html::encode($model->title)
                . '</div>';
    }

}
