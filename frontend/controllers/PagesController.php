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
    private function params() {
        $params = Yii::$app->request->queryParams;
        $league = Yii::$app->currentFootballData->getCurrentLeague(isset($params['idLeague']) ? $params['idLeague'] : null);
        $season = isset($params['season']) ? $params['season'] : Yii::$app->currentFootballData->getCurrentSeason($league->id);
        $tour = isset($params['tour']) ? $params['tour'] : Yii::$app->currentFootballData->getCurrentTour($season, $league->id);
        return [
            'n_tour' => $tour,
            'id_season' => $season,
            'id_league' => $league->id,
            'name_league' => $league->name,
            'type_league' => $league->type,
        ];
    }
    /*Functions controller*/
    public function getRegionGroup ($league) {
        $groups = TournamentSearch::find()->select('id_group')->where(['id_league' => $league])->groupBy('id_group')->all();
        return $groups;
    }
    /*actions*/
    public function actionResults() {
        $params = $this->params();
        $searchModel = new MatchesSearch();
        $dataProvider = $searchModel->search(['MatchesSearch' => array_slice($params, 0, 3)]);
        if ($params['type_league'] == 'play-off') {$dataProvider->query->andWhere(['not',['date_match'=> null]]);}
        return $this->render('results', [
            'providers' => ['played' => $dataProvider],
            'searchModel' => $searchModel,
            'dropList' => $searchModel->getList($params['id_season'], $params['id_league']),
            'current' => $params,
        ]);
    }

    public function actionTournament() {
        /*Set league`s data*/
        $params = $this->params();
        /*get list of matches in the league => season => tour*/
        $searchMatch = new MatchesSearch();
        if ($params['type_league'] == 'play-off') {
            $rounds = $searchMatch->getTours(array_slice($params, 1, 2));
            $tournament = [];
            foreach ($rounds as $round):
                $matchProvider = $searchMatch->search(['MatchesSearch' => array_merge(array_slice($params, 1, 2), ['n_tour' => $round->n_tour])]);
                array_push($tournament, $matchProvider);
            endforeach;
            return $this->render('tournament', [
                'tournament' => $tournament,
                'current' => $params,
            ]);
        } else {
            $matchProvider = $searchMatch->search(['MatchesSearch' => array_slice($params, 0, 3)]);
            //$matchProvider->query->andWhere(['not',['score_h'=> null]]);
        /*get tournament table or play-off depending on the league*/
            $searchTours = new TournamentSearch();
            if ($params['type_league'] == 'group') { //if type is group tour
                $groups = $this->getRegionGroup($params['id_league']); $tournament = []; // array have dataProvider every group
                foreach ($groups as $group):
                    $region = $searchTours->search(['TournamentSearch' => array_merge($params, ['id_group' => $group->id_group])]);
                    array_push($tournament, $region);
                endforeach;
            } else if ($params['type_league'] == 'tournament'){
                $tournament = $searchTours->search(['TournamentSearch' => $params]);
            }
            /*Render view*/
            return $this->render('tournament', [
                'matchProvider' => $matchProvider,
                'tournament' => $tournament,
                'dropList' => $searchTours->getList($params['id_season'], $params['id_league']),
                'current' => $params,
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
                Yii::$app->session->setFlash('success', '��������� �����������');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        } else {
            return $this->render('contacts', ['model' => $model]);
        }

    }


}
