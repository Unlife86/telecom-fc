<?php
namespace frontend\controllers;

use Yii;
use common\models\FootballTeam;
use frontend\models\FootballTeamSearch;
use frontend\models\MatchesSearch;
use frontend\models\TournamentSearch;
use frontend\models\ContactForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/*
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;*/
/**
 * Site controller
 */
class PagesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /*Functions controller*/
    public function getRegionGroup ($league) {
        $groups = TournamentSearch::find()->select('id_group')->where(['id_league' => $league])->groupBy('id_group')->all();
        return $groups;
    }
    /*actions*/
    public function actionResults($idLeague = null, $tour = null, $season = null) {
        if ($idLeague == null) {
            $idLeague = Yii::$app->currentFootballData->getCurrentLeague()->id;
            $nameLeague = Yii::$app->currentFootballData->getCurrentLeague()->name;
            $typeLeague = Yii::$app->currentFootballData->getCurrentLeague()->type;
        } else {
            $nameLeague = Yii::$app->currentFootballData->getCurrentLeague($idLeague)->name;
            $typeLeague = Yii::$app->currentFootballData->getCurrentLeague($idLeague)->type;
        }
        if ($season == null) {$season = Yii::$app->currentFootballData->getCurrentSeason($idLeague);}
        //if ($tour == null) {$tour = Yii::$app->currentFootballData->getCurrentTour($season, $idLeague);}
        $searchModel = new MatchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$calendarProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($tour == null) {
            $dataProvider->query->where(/*['and',['not',['score_h'=> null]],*/['id_season'=>$season, 'id_league' => $idLeague]/*]*/)->andWhere(['not',['date_match'=> null]])->orderBy(['n_tour' => SORT_ASC, 'date_match' => SORT_ASC]);
            //$calendarProvider->query->where(['score_h'=> null,'id_season'=>$season, 'id_league' => $idLeague])->orderBy(['n_tour' => SORT_ASC, 'date_match' => SORT_ASC]);
        } else {
            $dataProvider->query->where(/*['and',['not',['score_h'=> null]],*/['n_tour'=>$tour,'id_season'=>$season, 'id_league' => $idLeague]/*]*/)->andWhere(['not',['date_match'=> null]])->orderBy(['date_match' => SORT_ASC]);
            //$calendarProvider->query->where(['score_h'=> null,'n_tour'=>$tour,'id_season'=>$season, 'id_league' => $idLeague])->orderBy(['n_tour' => SORT_ASC, 'date_match' => SORT_ASC]);
        }
        return $this->render('results', [
            'providers' => ['played' => $dataProvider/*, 'calendar' => $calendarProvider*/],
            'searchModel' => $searchModel,
            'dropList' => $searchModel->getList($season, $idLeague),
            'current' => ['tour' => $tour, 'season' => $season, 'id_league' => $idLeague, 'name_league' => $nameLeague, 'type_league' => $typeLeague],
        ]);
    }

    public function actionTournament($idLeague = null, $tour = null, $season = null) {
        /*Set league`s data*/
        if ($idLeague == null) {
            $idLeague = Yii::$app->currentFootballData->getCurrentLeague()->id;
            $typeLeague = Yii::$app->currentFootballData->getCurrentLeague()->type;
            $nameLeague = Yii::$app->currentFootballData->getCurrentLeague()->name;
        } else {
            $typeLeague = Yii::$app->currentFootballData->getCurrentLeague($idLeague)->type;
            $nameLeague = Yii::$app->currentFootballData->getCurrentLeague($idLeague)->name;
        }
        /* Set current tour and season*/
        if ($season == null) {$season = Yii::$app->currentFootballData->getCurrentSeason($idLeague);}
        if ($tour == null) {$tour = Yii::$app->currentFootballData->getCurrentTour($season, $idLeague);}
        /*get list of matches in the league => season => tour*/
        $searchMatch = new MatchesSearch();
        if ($typeLeague == 'play-off') {
            $rounds = $searchMatch->getTours($season, $idLeague); $tournament = [];
            foreach ($rounds as $round):
                $matchProvider = $searchMatch->search(Yii::$app->request->queryParams);
                $matchProvider->query->where(['n_tour' => $round->n_tour, 'id_season'=>$season, 'id_league' => $idLeague]);
                array_push($tournament, $matchProvider);
            endforeach;
            return $this->render('tournament', [
                'tournament' => $tournament,
                'current' => ['tour' => $tour, 'season' => $season, 'name_league' => $nameLeague, 'type_league' => $typeLeague, 'id_league' => $idLeague],
            ]);
        } else {
            $matchProvider = $searchMatch->search(Yii::$app->request->queryParams);
            $matchProvider->query->where(['and',['not',['score_h'=> null]],['n_tour'=>$tour,'id_season'=>$season, 'id_league' => $idLeague]])->orderBy(['date_match' => SORT_DESC]);
        /*get tournament table or play-off depending on the league*/
            $searchTours = new TournamentSearch();
            if ($typeLeague == 'group') { //if type is group tour
                $groups = $this->getRegionGroup($idLeague); $tournament = []; // array have dataProvider every group
                foreach ($groups as $group):
                    $region = $searchTours->search(Yii::$app->request->queryParams);
                    $region->query->andWhere(['id_league' => $idLeague, 'n_tour'=> $tour, 'id_season'=>$season, 'id_group' => $group->id_group]);
                    array_push($tournament, $region);
                endforeach;
            } else if ($typeLeague == 'tournament'){
                $tournament = $searchTours->search(Yii::$app->request->queryParams); $tournament->query->andWhere(['id_league' => $idLeague, 'n_tour'=> $tour, 'id_season'=>$season]);
            }
            /*Render view*/
            return $this->render('tournament', [
                'matchProvider' => $matchProvider,
                'tournament' => $tournament,
                'dropList' => $searchTours->getList($season, $idLeague),
                'current' => ['tour' => $tour, 'season' => $season, 'name_league' => $nameLeague, 'type_league' => $typeLeague, 'id_league' => $idLeague],
            ]);
        }
    }

    public function actionStatic($id_team = null) {
        if ($id_team == null) {$id_team = 8;}
        $team = FootballTeam::findOne($id_team);
        $searchTeams = new FootballTeamSearch(); $teamProvider = $searchTeams->search(Yii::$app->request->queryParams);
        $searchMatch = new MatchesSearch(); $matchProvider = $searchMatch->search(Yii::$app->request->queryParams);
        $matchProvider->query->orWhere(['id_home'=>$id_team])->orWhere(['id_guest'=>$id_team])->andwhere(['not',['score_h'=> null]])->orderBy(['n_tour' => SORT_ASC]);
        return $this->render('static', [
            'matchProvider' => $matchProvider,
            'teamProvider' => $teamProvider,
            'team'=> $team,
        ]);
    }

    public function actionPlayer($id_player = null) {
        if ($id_player == null) {$id_player = 1;}

    }
    public function actionGallery() {
        return $this->render('gallery');
    }
    public function actionContacts() {
        $model = new ContactForm();
        if ($model -> load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['bossEmail'])) {
                Yii::$app->session->setFlash('success', 'Сообщение отправленно');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        } else {
            return $this->render('contacts', ['model' => $model]);
        }

    }


}
