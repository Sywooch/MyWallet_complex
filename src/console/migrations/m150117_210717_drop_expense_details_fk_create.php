<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_210717_drop_expense_details_fk_create extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `expense_account` ADD CONSTRAINT  `expence_account_expence_id` FOREIGN KEY (  `expense_id` ) REFERENCES  `mywallet`.`expense` (
                `id`
                ) ON DELETE RESTRICT ON UPDATE RESTRICT ;

                ALTER TABLE  `expense_account` ADD CONSTRAINT  `expence_account_account_id` FOREIGN KEY (  `account_id` ) REFERENCES  `mywallet`.`account` (
                `id`
                ) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE  `expense_account` DROP FOREIGN KEY  `expence_account_expence_id` ;
                ALTER TABLE  `expense_account` DROP FOREIGN KEY  `expence_account_account_id`;";
        $this->execute($sql);
    }
}
