<?php

use yii\db\Schema;
use yii\db\Migration;

class m150119_083005_account_type_fix extends Migration
{

    public function up() {
        $sql = "ALTER TABLE `mywallet`.`account` CHANGE COLUMN `type` `type` ENUM('money','credit','creditcard','invest','card','bonus') NOT NULL";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE `mywallet`.`account` CHANGE COLUMN `type` `type` ENUM('expense','income','money','credit','creditcard','invest','card') NOT NULL";
        $this->execute($sql);
    }

}
