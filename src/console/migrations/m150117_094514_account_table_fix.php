<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_094514_account_table_fix extends Migration
{

    public function up() {
        $sql = "ALTER TABLE `account`
                    DROP FOREIGN KEY `account_currency_id`,
                    ALTER TABLE `account`
                    CHANGE COLUMN `currency` `currency` VARCHAR(5) NULL DEFAULT 'RUR' ,
                    ADD COLUMN `virtual` TINYINT NOT NULL DEFAULT 0 AFTER `parent_id`;
                    ALTER TABLE `account`
                    ADD CONSTRAINT `account_currency_id`
                      FOREIGN KEY (`currency`)
                      REFERENCES `currency` (`id`);
                    ";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE `account`
                    DROP FOREIGN KEY `account_currency_id`,
                    ALTER TABLE `account`
                    DROP COLUMN `virtual`,
                    CHANGE COLUMN `currency` `currency` VARCHAR(5) NOT NULL DEFAULT 'RUR' ;
                    ALTER TABLE `account`
                    ADD CONSTRAINT `account_currency_id`
                      FOREIGN KEY (`currency`)
                      REFERENCES `currency` (`id`)
                      ON DELETE RESTRICT
                      ON UPDATE CASCADE;
                    ";
        $this->execute($sql);
    }

}
