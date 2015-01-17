<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_094514_account_table_fix extends Migration
{

    public function up() {
        $sql = "ALTER TABLE `mywallet`.`account`
                    DROP FOREIGN KEY `account_currency_id`,
                    DROP FOREIGN KEY `account_ibfk_4`;
                    ALTER TABLE `mywallet`.`account`
                    CHANGE COLUMN `currency` `currency` VARCHAR(5) NULL DEFAULT 'RUR' ,
                    ADD COLUMN `virtual` TINYINT NOT NULL DEFAULT 0 AFTER `parent_id`;
                    ALTER TABLE `mywallet`.`account`
                    ADD CONSTRAINT `account_currency_id`
                      FOREIGN KEY (`currency`)
                      REFERENCES `mywallet`.`currency` (`id`),
                    ADD CONSTRAINT `account_ibfk_4`
                      FOREIGN KEY (`currency`)
                      REFERENCES `mywallet`.`currency` (`id`);
                    ";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE `mywallet`.`account`
                    DROP FOREIGN KEY `account_currency_id`,
                    DROP FOREIGN KEY `account_ibfk_4`;
                    ALTER TABLE `mywallet`.`account`
                    DROP COLUMN `virtual`,
                    CHANGE COLUMN `currency` `currency` VARCHAR(5) NOT NULL DEFAULT 'RUR' ;
                    ALTER TABLE `mywallet`.`account`
                    ADD CONSTRAINT `account_currency_id`
                      FOREIGN KEY (`currency`)
                      REFERENCES `mywallet`.`currency` (`id`)
                      ON DELETE RESTRICT
                      ON UPDATE RESTRICT,
                    ADD CONSTRAINT `account_ibfk_4`
                      FOREIGN KEY (`currency`)
                      REFERENCES `mywallet`.`currency` (`id`);
                    ";
        $this->execute($sql);
    }

}
