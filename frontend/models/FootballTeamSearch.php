<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FootballTeam;

/**
 * FootballTeamSearch represents the model behind the search form about `backend\models\FootballTeam`.
 */
class FootballTeamSearch extends FootballTeam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_team', 'id_group'], 'integer'],
            [['name_team', 'alias_team', 'city'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FootballTeam::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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
}
