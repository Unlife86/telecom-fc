<?php

namespace frontend\models;

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
            [['n_tour', 'scored_goals', 'conceded_goals', 'c_wins', 'c_dead_heat', 'c_loses', 'current_point', 'positon_in_tour', 'plays'], 'integer'],
            [['id_team', 'id_league', 'id_group', 'id_season'], 'safe']
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Tournament::find()->with(['idLeague','idTeam','idSeason', 'idGroup']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_league' => SORT_DESC,
                    'n_tour' => SORT_DESC,
                    'current_point' => SORT_DESC,
                    'positon_in_tour'=> SORT_ASC,
                ]
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
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
        ]);
        return $dataProvider;
    }
    public function getList($season, $league) {
        $tours = Tournament::find()->select(['n_tour','id_league'])->where(['id_season' => $season, 'id_league' => $league])->orderBy(['n_tour' => SORT_DESC])->orderBy(['id_league' => SORT_ASC,'n_tour' => SORT_ASC])->groupBy(['n_tour','id_league'])->all();
        $seasons = Tournament::find()->select('id_season')->with('idSeason')->where(['id_league' => $league])->orderBy(['id_season' => SORT_DESC])->groupBy('id_season')->all();
        return ['seasons'=>$seasons, 'tours' => $tours];
    }
}
