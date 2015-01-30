<?php

use yii\db\Schema;
use yii\db\Migration;

class m150129_183140_transfer_account_fix extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `transfer_account` DROP FOREIGN KEY  `transfer_account_transfer_id` ;

ALTER TABLE  `transfer_account` ADD CONSTRAINT  `transfer_account_transfer_id` FOREIGN KEY (  `transfer_id` ) REFERENCES  `mywallet`.`transfer` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;

ALTER TABLE  `transfer_account` DROP FOREIGN KEY  `transfer_account_account_id` ;

ALTER TABLE  `transfer_account` ADD CONSTRAINT  `transfer_account_account_id` FOREIGN KEY (  `account_id` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE  `transfer_account` DROP FOREIGN KEY  `transfer_account_transfer_id` ;

ALTER TABLE  `transfer_account` ADD CONSTRAINT  `transfer_account_transfer_id` FOREIGN KEY (  `transfer_id` ) REFERENCES  `mywallet`.`transfer` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `transfer_account` DROP FOREIGN KEY  `transfer_account_account_id` ;

ALTER TABLE  `transfer_account` ADD CONSTRAINT  `transfer_account_account_id` FOREIGN KEY (  `account_id` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
        $this->execute($sql);
    }
}
