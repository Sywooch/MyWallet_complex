<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_173952_transfer_type extends Migration {

    public function up() {
        $sql = "ALTER TABLE  `transfer` ADD  `type` ENUM(  'incoming',  'outgoing',  'internal' ) NOT NULL AFTER  `date` ,
                    ADD INDEX (  `type` ) ;";
        $this->execute($sql);
    }

    public function down() {
        $sql = "ALTER TABLE  `transfer` DROP  `type` ;";
        $this->execute($sql);
    }

}
