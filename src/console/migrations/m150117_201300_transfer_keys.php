<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_201300_transfer_keys extends Migration
{
    public function up()
    {
        $sql = "ALTER TABLE  `transfer` ADD CONSTRAINT  `transfer_source` FOREIGN KEY (  `source` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `transfer` ADD CONSTRAINT  `transfer_dest` FOREIGN KEY (  `dest` ) REFERENCES  `mywallet`.`account` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE  `transfer` DROP FOREIGN KEY  `transfer_source` ;

ALTER TABLE  `transfer` DROP FOREIGN KEY  `transfer_dest`";
        $this->execute($sql);
    }
}
