<?php

use yii\db\Schema;
use yii\db\Migration;

class m150128_200755_transfer_account_type_field extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `transfer_account` ADD  `type` ENUM(  'in',  'out' ) NOT NULL AFTER  `account_id` ,
ADD INDEX (  `type` ) ;";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE `transfer_account` DROP `type`";
        $this->execute($sql);
    }
}
