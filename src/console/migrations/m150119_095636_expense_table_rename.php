<?php

use yii\db\Schema;
use yii\db\Migration;

class m150119_095636_expense_table_rename extends Migration
{

    public function up() {
        $sql = "ALTER TABLE `expense` RENAME TO  `transaction`";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE `transaction` RENAME TO  `expense`";
        $this->execute($sql);
    }

}
