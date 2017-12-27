<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $header_event
 * @property string $date_event
 * @property integer $publish_status_id
 * @property string $full_text
 *
 * @property TypePublish $publishStatus
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header_event', 'date_event', 'full_text'], 'required'],
            [['date_event'], 'safe'],
            [['publish_status_id'], 'integer'],
            [['full_text'], 'string'],
            [['header_event'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header_event' => 'Заголовок',
            'date_event' => 'Дата',
            'publish_status_id' => 'Статус',
            'full_text' => 'Полный текст',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishStatus()
    {
        return $this->hasOne(TypePublish::className(), ['id' => 'publish_status_id']);
    }
}
