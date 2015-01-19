<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_210707_drop_expense_details_fk_drop extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `expense_account` DROP FOREIGN KEY  `expense_account_ibfk_1` ;
                ALTER TABLE  `expense_account` DROP FOREIGN KEY  `expense_account_ibfk_2`;";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE  `expense_account` ADD CONSTRAINT  `expense_account_ibfk_2` FOREIGN KEY (  `expense_id` ) REFERENCES  `mywallet`.`expense` (
                `id`
                ) ON DELETE RESTRICT ON UPDATE RESTRICT ;

                ALTER TABLE  `expense_account` ADD CONSTRAINT  `expense_account_ibfk_1` FOREIGN KEY (  `account_id` ) REFERENCES  `mywallet`.`account` (
                `id`
                ) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
        $this->execute($sql);
    }
}
