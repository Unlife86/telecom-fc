<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tournament;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

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
        $query = static::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_season' => SORT_DESC,
                    'id_league' => SORT_DESC,
                    'id_group' => SORT_ASC,
                    'n_tour' => SORT_DESC,
                    'positon_in_tour'=> SORT_ASC,
                ]
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->with(['idLeague','idTeam','idSeason', 'idGroup']);
        $query->andFilterWhere([
                'n_tour' => $this->n_tour,
                'id_team' => $this->id_team,
                'id_league' => $this->id_league,
                'id_group' => $this->id_group,
                'id_season' => $this->id_season,
            ]);
        return $dataProvider;
    }

    public function columns()
    {
        return [  
            [
                'attribute' => 'id_season',
                'filter' => true,
                'value' => 'idSeason.year'
            ],
            [
                'attribute' => 'id_league',
                'filter' => true,
                'value' => 'idLeague.name'
            ],
            [
                'attribute' => 'id_group',
                'filter' => true,
                'value' => 'idGroup.name_group'
            ],            
            [
                'attribute' => 'n_tour',
                'filter' => true
            ],
            [
                'attribute' => 'id_team',
                'filter' => true
            ],            
            'positon_in_tour',
            'plays',
            'c_wins',
            'c_dead_heat',
            'c_loses',
            'scored_goals',
            'conceded_goals',
            'current_point',
            ['class' => 'yii\grid\ActionColumn'],
        ];
    }

    public function toolbarContent()
    {
        return Html::a(Html::tag('i', null, ['class' => 'glyphicon glyphicon-plus']).Html::tag('strong', 'Тур', []), ['create', $this->formName() => [
                    'id_league' => $this->id_league,
                    'id_season' => $this->id_season,
                    'n_tour' => $this->n_tour,
                    'id_group' => $this->id_group
                ]], ['class' => 'btn btn-success']);   
    }

    public function getIdTeam()
    {
        return $this->hasOne(FootballTeamSearch::className(), ['id_team' => 'id_team']);
    }
    
}
