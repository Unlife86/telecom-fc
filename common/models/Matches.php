<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "matches".
 *
 * @property integer $id
 * @property string $date_match
 * @property integer $id_season
 * @property integer $n_tour
 * @property integer $id_home
 * @property integer $id_guest
 * @property integer $score_h
 * @property integer $score_g
 * @property integer $id_league
 * @property integer $id_stadium
 *
 * @property FootballTeam $idGuest
 * @property FootballTeam $idHome
 * @property League $idLeague
 * @property Stadiums $idStadium
 * @property Seasons $idSeason
 */
class Matches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['date_match', 'id_season', 'n_tour', 'id_home', 'id_guest', 'id_league'], 'required'],
            [['date_match'], 'safe'],
            [['id_season', 'n_tour', 'id_league'], 'required'],
            [['id_season', 'n_tour', 'id_home', 'id_guest', 'score_h', 'score_g', 'id_league', 'id_stadium'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_match' => 'Дата матча',
            'id_season' => 'Сезон',
            'n_tour' => 'Тур',
            'id_home' => 'Хозяева',
            'id_guest' => 'Гости',
            'score_h' => 'Score Home Team',
            'score_g' => 'Score Guest Team',
            'id_league' => 'Турнир',
            'id_stadium' => 'Стадион',
        ];
    }
    public function getIdGuest()
    {
        return $this->hasOne(FootballTeam::className(), ['id_team' => 'id_guest']);
    }
    public function getIdHome()
    {
        return $this->hasOne(FootballTeam::className(), ['id_team' => 'id_home']);
    }
    public function getIdLeague()
    {
        return $this->hasOne(League::className(), ['id' => 'id_league']);
    }
    public function getIdStadium()
    {
        return $this->hasOne(Stadiums::className(), ['id' => 'id_stadium']);
    }
    public function getIdSeason()
    {
        return $this->hasOne(Seasons::className(), ['id' => 'id_season']);
    }
}
