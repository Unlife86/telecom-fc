<?php

namespace common\models;

use Yii;

class Matches extends \yii\db\ActiveRecord
{
    public $oldHome;
    public $oldGuest;

    public static function tableName()
    {
        return 'matches';
    }
    public function rules()
    {
        return [
            [['date_match'], 'safe'],
            [['id_season', 'n_tour', 'id_league'], 'required'],
            [['id_season', 'n_tour', 'id_home', 'id_guest', 'score_h', 'score_g', 'id_league', 'id_stadium', 'postponed'], 'integer']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_match' => 'Дата матча',
            'id_season' => 'Сезон',
            'n_tour' => 'Тур',
            'id_home' => 'Хозяева',
            'id_guest' => 'Гости',
            'score_h' => 'Голы хозяев',
            'score_g' => 'Голы гостей',
            'id_league' => 'Турнир',
            'id_stadium' => 'Стадион',
        ];
    }

    public function getIdGuest()
    {
        return $this->hasOne(FootballTeam::className(), ['id_team' => 'id_guest'])->from(FootballTeam::tableName() . ' g');
    }
    public function getIdHome()
    {
        return $this->hasOne(FootballTeam::className(), ['id_team' => 'id_home'])->from(FootballTeam::tableName() . ' h');
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
    public function getIdReviewVideo()
    {
        return $this->hasOne(RemoteMediaFiles::className(),['id' => 'remote_media_file_id'/*, 'type' => 1*/])
            ->viaTable(MatchesRemoteMediaFiles::tableName(), ['match_id' => 'id'/*, 'type' => 3*/]);
    }

    public function getLeagues()
    {
        return League::find()->groupBy('name')->orderBy('id')->all();
    }
    public function getSeasons()
    {
        return static::find()->groupBy('id_season')->orderBy('id_season')->all();
    }
    
    /*
     * Functions for event update tournament table after updating the match result
     */
    public function updateScore($item, $model, $attr)
    {
        if ($attr[$item['scored_goals']] > $attr[$item['conceded_goals']]) {
            $model->c_wins = $model->c_wins + 1;
        } elseif ($attr[$item['scored_goals']] == $attr[$item['conceded_goals']]) {
            $model->c_dead_heat = $model->c_dead_heat + 1;
        } elseif ($attr[$item['scored_goals']] < $attr[$item['conceded_goals']]) {
            $model->c_loses = $model->c_loses + 1;
        }
        $model->current_point = (3 * $model->c_wins) + $model->c_dead_heat;
    }
    public function updateTournament($attr)
    {
        $arr = [
            ['team_id' => $attr['id_home'], 'scored_goals' => 'score_h', 'conceded_goals' => 'score_g'],
            ['team_id' => $attr['id_guest'], 'scored_goals' => 'score_g', 'conceded_goals' => 'score_h'],
        ];
        foreach ($arr as $item):
            $model = Tournament::find()->where(['id_league'=>$attr['id_league'], 'id_season'=>$attr['id_season'], 'n_tour'=>$attr['n_tour'], 'id_team' => $item['team_id']])->one();
            if (($this->oldHome == 0) and ($this->oldGuest == 0)) {
                $model->scored_goals = $model->scored_goals + $attr[$item['scored_goals']]; $model->conceded_goals = $model->conceded_goals + $attr[$item['conceded_goals']]; $model->plays = $model->plays + 1;
                $this->updateScore($item, $model, $attr);
            } elseif (($this->oldHome > 0) and ($this->oldGuest > 0)) {
                $this->updateScore($item, $model, $attr);
            }
            $model->save();
        endforeach;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->oldGuest = strlen($this->getOldAttribute('score_g'));
            $this->oldHome = strlen($this->getOldAttribute('score_h'));
            return true;
        } else {
            return false;
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->idLeague->type != 'play-off' && $attr['id'] != 167) {
            $attr = $this->getAttributes();
            if ((strlen($attr['score_h']) > 0) and (strlen($attr['score_g']) > 0)) {
            $this->updateTournament($attr);
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
