<?php

use yii\db\Schema;
use yii\db\Migration;

class m150128_193943_transfer_table_fix extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `transfer` DROP FOREIGN KEY  `transfer_source` ;

ALTER TABLE  `transfer` DROP FOREIGN KEY  `transfer_dest` ;";
        $this->execute($sql);

    }

    public function down()
    {
        $sql = "ALTER TABLE  `transfer` ADD FOREIGN KEY (  `transfer_source` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `transfer` ADD FOREIGN KEY (  `transfer_dest` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
        $this->execute($sql);

    }
}
