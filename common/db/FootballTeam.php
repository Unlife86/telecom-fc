<?php

namespace common\models;

use Yii;

class FootballTeam extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'football_team';
    }
    public function rules()
    {
        return [
            [['name_team', 'alias_team', 'city'], 'required'],
            [['id_group'], 'integer'],
            [['name_team', 'alias_team', 'city'], 'string', 'max' => 45]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_team' => '#',
            'name_team' => 'Наименование',
            'alias_team' => 'Псевдоним',
            'city' => 'Город',
            'id_group' => 'Группа',
        ];
    }
    
    public function getIdGroup()
    {
        return $this->hasOne(RegionGroup::className(), ['id' => 'id_group']);
    }
    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['id_guest' => 'id_team']);
    }
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['id_team' => 'id_team']);
    }

}
