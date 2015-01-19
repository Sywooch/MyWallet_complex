<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_184517_account_fk extends Migration
{
    public function up()
    {
        $sql = "
ALTER TABLE  `account` ADD CONSTRAINT  `account_user_id` FOREIGN KEY (  `user_id` ) REFERENCES  `user` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `account` ADD CONSTRAINT  `account_currency_id` FOREIGN KEY (  `currency` ) REFERENCES  `currency` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;

ALTER TABLE  `account` ADD CONSTRAINT  `account_parent_id` FOREIGN KEY (  `parent_id` ) REFERENCES  `account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE  `account` DROP FOREIGN KEY  `account_user_id` ;

ALTER TABLE  `account` DROP FOREIGN KEY  `account_currency_id` ;

ALTER TABLE  `account` DROP FOREIGN KEY  `account_parent_id` ;";
        $this->execute($sql);
    }
}
