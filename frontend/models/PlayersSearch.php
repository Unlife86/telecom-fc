<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Players;

/**
 * PlayersSearch represents the model behind the search form about `backend\models\Players`.
 */
class PlayersSearch extends Players
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'age', 'n_player'], 'integer'],
            [['first_name_player', 'middle_name_player', 'last_name_player', 'date_birth', 'facebook', 'twiter', 'vk', 'ok', 'google'], 'safe'],
            [['height'], 'number'],
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
        $query = Players::find();

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
            'id' => $this->id,
            'type_id' => $this->type_id,
            'age' => $this->age,
            'n_player' => $this->n_player,
            'date_birth' => $this->date_birth,
            'height' => $this->height,
        ]);

        $query->andFilterWhere(['like', 'first_name_player', $this->first_name_player])
            ->andFilterWhere(['like', 'middle_name_player', $this->middle_name_player])
            ->andFilterWhere(['like', 'last_name_player', $this->last_name_player])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twiter', $this->twiter])
            ->andFilterWhere(['like', 'vk', $this->vk])
            ->andFilterWhere(['like', 'ok', $this->ok])
            ->andFilterWhere(['like', 'google', $this->google]);

        return $dataProvider;
    }
}
