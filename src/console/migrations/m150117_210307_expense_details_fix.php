<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_210307_expense_details_fix extends Migration
{
    public function up()
    {
        $sql = "RENAME TABLE  `mywallet`.`expense_pay` TO  `mywallet`.`expense_details`";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "RENAME TABLE  `mywallet`.`expense_details` TO  `mywallet`.`expense_pay`";
        $this->execute($sql);
    }
}
