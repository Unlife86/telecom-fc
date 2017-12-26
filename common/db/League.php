<?php

namespace common\models;

use Yii;

class League extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'league';
    }
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['current'], 'integer'],
            [['name', 'type'], 'string', 'max' => 45],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип',
            'current' => 'Текущая'
        ];
    }

    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['id_league' => 'id']);
    }
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['id_league' => 'id']);
    }
}
