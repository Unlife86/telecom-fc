<?php

namespace backend\models;

use common\models\League;
use common\models\RegionGroup;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tournament;


class TournamentSearch extends Tournament
{
    public function rules()
    {
        return [
            //[['n_tour', 'id_season', 'id_team', 'plays', 'id_league'], 'required'],
            [['n_tour', 'id_season', 'scored_goals', 'conceded_goals', 'c_wins', 'c_dead_heat', 'c_loses', 'current_point', 'positon_in_tour', 'plays'], 'integer'],
            [['id_team', 'id_league', 'id_group'], 'safe']
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Tournament::find()->orderBy(['id_season' => SORT_DESC, 'n_tour' => SORT_DESC, 'positon_in_tour'=> SORT_ASC,]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->with(['idLeague','idTeam','idSeason', 'idGroup']);
           /* ->joinWith('idSeason')
            ->joinWith('idGroup');*/
        /*$query->andFilterWhere([
            'n_tour' => $this->n_tour,
            'id_season' => $this->id_season,
            'id_team' => $this->id_team,
            'scored_goals' => $this->scored_goals,
            'conceded_goals' => $this->conceded_goals,
            'c_wins' => $this->c_wins,
            'c_dead_heat' => $this->c_dead_heat,
            'c_loses' => $this->c_loses,
            'current_point' => $this->current_point,
            'positon_in_tour' => $this->positon_in_tour,
            'id' => $this->id,
            'id_league' => $this->id_league,
            'plays' => $this->plays,
            'id_group' => $this->id_group,
        ]);*/
       $query->andFilterWhere([
            'n_tour' => $this->n_tour,
            'id_team' => $this->id_team,
            'id_league' => $this->id_league,
            'id_group' => $this->id_group,
            /*'scored_goals' => $this->scored_goals,
            'conceded_goals' => $this->conceded_goals,
            'c_wins' => $this->c_wins,
            'c_dead_heat' => $this->c_dead_heat,
            'c_loses' => $this->c_loses,
            'current_point' => $this->current_point,
            'positon_in_tour' => $this->positon_in_tour,
           'id' => $this->id,
            'plays' => $this->plays,*/
        ]);
        $query/*->andFilterWhere(['like', 'football_team.name_team', $this->id_team])*/
            ->andFilterWhere(['like', 'seasons.year', $this->id_season]);
        return $dataProvider;
    }
    public function Leagues () {
        return League::find()->where(['not',['type'=> 'play-off']])->all();
    }
    public function RegionGroup($id_league) {
        return Tournament::find()->with('idGroup')->where(['id_league' => $id_league])->all();
    }
}
