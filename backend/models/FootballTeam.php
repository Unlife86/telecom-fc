<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "football_team".
 *
 * @property integer $id_team
 * @property string $name_team
 * @property string $alias_team
 *
 * @property Matches[] $matches
 * @property Matches[] $matches0
 * @property Tournament[] $tournaments
 */
class FootballTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'football_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_team', 'alias_team', 'city'], 'required'],
            [['id_group'], 'integer'],
            [['name_team', 'alias_team', 'city'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_team' => '#',
            'name_team' => 'Наименование',
            'alias_team' => 'Алиас',
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
