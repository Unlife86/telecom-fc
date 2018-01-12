<?php

use yii\db\Migration;

class m170605_094414_remote_media_files extends Migration
{
    public function up()
    {
        $this->createTable('remote_media_files', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),

            /*
            * Type = ['1' => 'video', '2' => 'image']
            */
            'type' => $this->integer()->defaultValue(1),
        ]);
    }

    public function down()
    {
        $this->dropTable('remote_media_files');
    }

}
