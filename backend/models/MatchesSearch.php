<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Matches;

/**
 * MatchesSearch represents the model behind the search form about `backend\models\Matches`.
 */
class MatchesSearch extends Matches
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_season', 'n_tour', 'id_home', 'id_guest', 'score_h', 'score_g', 'id_league', 'id_stadium'], 'integer'],
            [['date_match'], 'safe'],
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
        $query = Matches::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'date_match' => $this->date_match,
            'id_season'=>$this->id_season,
            'n_tour' => $this->n_tour,
            'id_home' => $this->id_home,
            'id_guest' => $this->id_guest,
            'score_h' => $this->score_h,
            'score_g' => $this->score_g,
            'id_league' => $this->id_league,
            'id_stadium' => $this->id_stadium,
        ]);
        return $dataProvider;
    }
    public function getProvider($group = null)
    {
        if (Yii::$app->request->get('league') == null) {
            $query = Matches::find()->joinWith('idLeague')->where(['league.current' => 1]);
        } else {
            $query = Matches::find()->with(['idSeason'])->where(['id_league' => Yii::$app->request->get('league')]);
        }
        if ($group != null) {
            $query->groupBy($group);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        return $dataProvider;
    }
    public function dataList()
    {
        $provider = $this->getProvider(['id_season', 'n_tour']);
        $data = []; $models = $provider->getModels();
        /*foreach($models as $model):
            array_push($data, ArrayHelper::toArray($model,[
                'backend\models\Matches' => [
                    'n_tour',
                    'id_season',
                ],
            ]));
        endforeach;
        ArrayHelper::multisort($data,['id_season','n_tour'],[SORT_DESC,SORT_DESC]);*/
        return $models;
    }



    public function getList($season, $league) {
        if ($league >= 3) {
            $tours = Matches::find()->select(['n_tour','id_league'])->where(['id_season' => $season])->andWhere(['>=','id_league', 3])->orderBy(['id_league' => SORT_ASC,'n_tour' => SORT_ASC])->groupBy(['n_tour','id_league'])->all();
        } else {
            $tours = Matches::find()->select(['n_tour','id_league'])->where(['id_season' => $season, 'id_league' => $league])->orderBy(['n_tour' => SORT_ASC])->groupBy(['n_tour','id_league'])->all();
        }
        $seasons = Matches::find()->select('id_season')->with('idSeason')->where(['id_league' => $league])->orderBy(['id_season' => SORT_DESC])->groupBy('id_season')->all();
        return ['seasons'=>$seasons, 'tours' => $tours];
    }
    public function getTours($season, $league) {
        $tours = Matches::find()->select('n_tour')->where(['id_season' => $season, 'id_league' => $league])->orderBy(['n_tour' => SORT_ASC])->groupBy('n_tour')->all();
        return $tours;
    }
    public function getTeams($league, $season, $tour) {
        $guest = Matches::find()->select(['id_guest'])->with('idGuest')->where(['n_tour' => $tour, 'id_season' => $season, 'id_league' => $league]);
        $teams = Matches::find()->select(['id_home'])->with('idHome')->where(['n_tour' => $tour, 'id_season' => $season, 'id_league' => $league])->union($guest)/*->all()*/;
        $dataProvider = new ActiveDataProvider([
            'query' => $teams,
        ]);
        return $dataProvider;
    }
}
