<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_173120_balance_table extends Migration
{
    public function up()
    {
        $sql = "RENAME TABLE  `mywallet`.`starting` TO  `mywallet`.`balance`";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "RENAME TABLE  `mywallet`.`balance` TO  `mywallet`.`starting`";
        $this->execute($sql);
    }
}
