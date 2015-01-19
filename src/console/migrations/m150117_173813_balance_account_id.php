<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_173813_balance_account_id extends Migration {

    public function up() {
        $sql = "ALTER TABLE  `balance` ADD CONSTRAINT  `balance_account_id` FOREIGN KEY (  `account_id` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE  `balance` DROP FOREIGN KEY  `balance_account_id`";
        $this->execute($sql);
    }

}
