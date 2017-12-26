<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stadiums".
 *
 * @property integer $id
 * @property string $name
 * @property string $city
 * @property string $address
 *
 * @property Matches[] $matches
 */
class Stadiums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stadiums';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city', 'address'], 'required'],
            [['name', 'city', 'address'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'city' => 'City',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['id_stadium' => 'id']);
    }
}
