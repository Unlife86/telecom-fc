<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "players".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $first_name_player
 * @property string $middle_name_player
 * @property string $last_name_player
 * @property integer $age
 * @property integer $n_player
 * @property string $date_birth
 * @property string $height
 * @property string $facebook
 * @property string $twiter
 * @property string $vk
 * @property string $ok
 * @property string $google
 *
 * @property TypePlayers $type
 */
class Players extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'first_name_player', 'middle_name_player', 'last_name_player', 'age', 'n_player', 'date_birth', 'height'], 'required'],
            [['type_id', 'age', 'n_player'], 'integer'],
            [['date_birth'], 'safe'],
            [['height'], 'number'],
            [['first_name_player', 'middle_name_player', 'last_name_player'], 'string', 'max' => 45],
            [['facebook', 'twiter', 'vk', 'ok', 'google'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Position',
            'first_name_player' => 'First Name',
            'middle_name_player' => 'Middle Name',
            'last_name_player' => 'Last Name',
            'age' => 'Age',
            'n_player' => 'Number',
            'date_birth' => 'Date Birth',
            'height' => 'Height',
            'facebook' => 'Facebook',
            'twiter' => 'Twiter',
            'vk' => 'Vk',
            'ok' => 'Ok',
            'google' => 'Google',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypePlayers::className(), ['id' => 'type_id']);
    }
}
