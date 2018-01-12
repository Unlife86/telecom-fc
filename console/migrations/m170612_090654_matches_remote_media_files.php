<?php

use yii\db\Migration;

class m170612_090654_matches_remote_media_files extends Migration
{
    public function up()
    {
        $this->createTable('matches_remote_media_files', [
            'remote_media_file_id' => $this->integer(),
            'match_id' => $this->integer(),
            'PRIMARY KEY(remote_media_file_id, match_id)',

            /*
            * Type = ['1' => 'preview', '2' => 'full', '3' => 'review']
            */
            'type' => $this->integer()->defaultValue(3),
        ]);

        /*
        * Foreign key remote_media_file_id
        */
        $this->createIndex(
            'idx-matches_remote_media_files-remote_media_file_id',
            'matches_remote_media_files',
            'remote_media_file_id'
        );

        $this->addForeignKey(
            'fk-matches_remote_media_files-remote_media_file_id',
            'matches_remote_media_files',
            'remote_media_file_id',
            'remote_media_files',
            'id',
            'CASCADE'
        );

        /*
        * Foreign key match_id
        */
        $this->createIndex(
            'idx-matches_remote_media_files-match_id',
            'matches_remote_media_files',
            'match_id'
        );

        $this->addForeignKey(
            'fk-matches_remote_media_files-match_id',
            'matches_remote_media_files',
            'remote_media_file_id',
            'matches',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-matches_remote_media_files-match_id',
            'matches_remote_media_files'
        );
        
        $this->dropIndex(
            'idx-matches_remote_media_files-match_id',
            'matches_remote_media_files'
        );

        $this->dropForeignKey(
            'fk-matches_remote_media_files-remote_media_file_id',
            'matches_remote_media_files'
        );

        $this->dropIndex(
            'idx-matches_remote_media_files-remote_media_file_id',
            'matches_remote_media_files'
        );
        
        $this->dropTable('matches_remote_media_files');
    }
}
