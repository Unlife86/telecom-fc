<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FootballTeam;

class FootballTeamSearch extends FootballTeam
{

    public function rules()
    {
        return [
            [['id_team', 'id_group'], 'integer'],
            [['name_team', 'alias_team', 'city'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = FootballTeam::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_team' => $this->id_team,
            'id_group' => $this->id_group,
        ]);

        $query->andFilterWhere(['like', 'name_team', $this->name_team])
            ->andFilterWhere(['like', 'alias_team', $this->alias_team])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }

    public function afterFind() 
    {
        parent::afterFind();
        $this->name_team = $this->name_team .' ( '. $this->city.')';
    }

}
