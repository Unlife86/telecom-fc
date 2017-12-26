<?php

namespace common\models;


class MatchesRemoteMediaFiles extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'matches_remote_media_files';
    }

    public function rules()
    {
        return [
            [['remote_media_file_id', 'match_id'], 'required'],
            [[['remote_media_file_id', 'match_id', 'type']], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'remote_media_file_id' => 'ID Медиа-файла',
            'match_id' => 'ID Матча',
        ];
    }
}
