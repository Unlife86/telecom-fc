<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tournament".
 *
 * @property integer $n_tour
 * @property integer $id_season
 * @property integer $id_team
 * @property integer $scored_goals
 * @property integer $conceded_goals
 * @property integer $c_wins
 * @property integer $c_dead_heat
 * @property integer $c_loses
 * @property integer $current_point
 * @property integer $positon_in_tour
 * @property integer $id
 * @property integer $id_group
 *
 * @property Seasons $idSeason
 * @property FootballTeam $idTeam
 * @property RegionGroup $idGroup
 */
class Tournament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tournament';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['n_tour', 'id_season', 'id_team', 'id_league'], 'required'],
            [['n_tour', 'id_season', 'id_team', 'scored_goals', 'conceded_goals', 'c_wins', 'c_dead_heat', 'c_loses', 'current_point', 'positon_in_tour', 'plays', 'id_league', 'id_group'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'n_tour' => 'Тур',
            'id_season' => 'Сезон',
            'id_team' => 'Команда',
            'scored_goals' => 'Заб. мячи',
            'conceded_goals' => 'Проп. мячи',
            'c_wins' => 'Победы',
            'c_dead_heat' => 'Ничьи',
            'c_loses' => 'Пораж.',
            'current_point' => 'Очки',
            'positon_in_tour' => 'Позиция',
            'id' => 'ID',
            'plays' => 'Игры',
            'id_league' => 'Турнир',
            'id_group' => 'Группа',
        ];
    }
    public function getIdSeason()
    {
        return $this->hasOne(Seasons::className(), ['id' => 'id_season']);
    }
    public function getIdTeam()
    {
        return $this->hasOne(FootballTeam::className(), ['id_team' => 'id_team']);
    }
    public function getIdGroup()
    {
        return $this->hasOne(RegionGroup::className(), ['id' => 'id_group']);
    }
    public function getIdLeague()
    {
        return $this->hasOne(League::className(), ['id' => 'id_league']);
    }

}
