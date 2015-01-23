<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_190315_transfer_account_table extends Migration {

    public function up() {
        $sql = "CREATE TABLE IF NOT EXISTS `transfer_account` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `transfer_id` int(11) unsigned NOT NULL,
                    `account_id` int(11) unsigned NOT NULL,
                    `sum` decimal(10,4) NOT NULL,
                    `description` varchar(1024) DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    KEY `transfer_id` (`transfer_id`),
                    KEY `account_id` (`account_id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

                  ALTER TABLE `transfer_account`
                    ADD CONSTRAINT `transfer_account_transfer_id` FOREIGN KEY (`transfer_id`) REFERENCES `transfer` (`id`),
                    ADD CONSTRAINT `transfer_account_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)";
        $this->execute($sql);
    }

    public function down() {
        $this->dropTable('transfer_account');
    }

}
