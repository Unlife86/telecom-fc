<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Matches;

class MatchesSearch extends Matches
{
    
    public function rules()
    {
        return [
            [['id', 'id_season', 'n_tour', 'id_home', 'id_guest', 'score_h', 'score_g', 'id_league', 'id_stadium', 'postponed'], 'integer'],
            [['date_match'], 'safe'],
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
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'postponed' => SORT_ASC,
                    'date_match' => SORT_ASC,
                ],
            ],
        ]);

        if (is_null($this->id)) {
            $query->joinWith(['idLeague', 'idStadium', 'idSeason', 'idHome', 'idGuest']);
        }

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            $this->tableName().'.id' => $this->id,
            'date_match' => $this->date_match,
            'id_season'=>$this->id_season,
            'n_tour' => $this->n_tour,
            'id_home' => $this->id_home,
            'id_guest' => $this->id_guest,
            'score_h' => $this->score_h,
            'score_g' => $this->score_g,
            'id_league' => $this->id_league,
            'id_stadium' => $this->id_stadium,
            'postponed' => $this->postponed,
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
        return $models;
    }
    public function getList($season, $league) {
        if ($league >= 3 && $league <= 4) {
            $tours = Matches::find()->select(['n_tour','id_league'])->where(['id_season' => $season])->andWhere(['>=','id_league', 3])->andWhere(['not',['date_match'=> null]])->orderBy(['id_league' => SORT_ASC,'n_tour' => SORT_ASC])->groupBy(['n_tour','id_league'])->all();
        } else {
            $tours = Matches::find()->select(['n_tour','id_league'])->where(['id_season' => $season, 'id_league' => $league])->andWhere(['not',['date_match'=> null]])->orderBy(['n_tour' => SORT_ASC])->groupBy(['n_tour','id_league'])->all();
        }
        $seasons = Matches::find()->select('id_season')->with('idSeason')->where(['id_league' => $league])->orderBy(['id_season' => SORT_DESC])->groupBy('id_season')->all();
        return ['seasons'=>$seasons, 'tours' => $tours];
    }
    public function getTours($params, $type_league = false, $sort = SORT_ASC) {
        $this->load($params);
        $tours = Matches::find()->select('n_tour')->filterWhere(['id_season' => $this->id_season, 'id_league' => $this->id_league]);
        if ($type_league) {
            $tours = $type_league == 'play-off' ? $tours->andWhere('n_tour <= '.$this->n_tour)->limit(3) : $tours->andWhere('n_tour >= '.$this->n_tour)->limit(2);
        }
        $tours = $tours->orderBy(['n_tour' => $sort])->groupBy('n_tour')->all();
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
