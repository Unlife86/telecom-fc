<?php

namespace common\models;



class RemoteMediaFiles extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'remote_media_files';
    }

    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['type'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '#',
            'url' => 'URL',
            'type' => 'Тип файла'
        ];
    }

}
