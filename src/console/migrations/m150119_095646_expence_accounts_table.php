<?php

use yii\db\Schema;
use yii\db\Migration;

class m150119_095646_expence_accounts_table extends Migration
{

    public function up() {
        $sql = "CREATE TABLE `expense` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `user_id` int(11) NOT NULL,
                    `title` varchar(255) NOT NULL,
                    `parent_id` int(11) unsigned DEFAULT NULL,
                    `virtual` tinyint(4) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`),
                    KEY `user_id` (`user_id`),
                    KEY `parent_id` (`parent_id`),
                    CONSTRAINT `expense_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `expense` (`id`),
                    CONSTRAINT `expense_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $this->execute($sql);
    }

    public function down() {
        $this->dropTable('expense');
    }

}
