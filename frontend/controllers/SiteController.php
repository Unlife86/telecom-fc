<?php
namespace frontend\controllers;

use Yii;
/*use backend\models\Matches;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;*/
use frontend\models\MatchesSearch;
use frontend\models\TournamentSearch;
use frontend\models\PlayersSearch;
use frontend\models\NewsSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
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
    public $layout = 'base';
    public function actionIndex()
    {
        $season = Yii::$app->currentFootballData->getCurrentSeason();
        $tour = Yii::$app->currentFootballData->getCurrentTour();
        $league = Yii::$app->currentFootballData->getCurrentLeague();

        $searchMatches = new MatchesSearch(['id_season' => $season]);
        $matches = $searchMatches->search(Yii::$app->request->queryParams);$matches->pagination->pageSize=3; $matches->totalCount=3;
        if ($league->id == 4) {
            $matches->query->where(['and',['>=','id_league', 3],['or','id_guest=8', 'id_home=8']])->orderBy(['date_match' => SORT_ASC]);
        } else {
            $matches->query->where(['and',['id_league' => $league->id],['or','id_guest=8', 'id_home=8']])->orderBy(['date_match' => SORT_ASC]);
        }

        if ($league->type == 'play-off') {
            $tours = $searchMatches->search(Yii::$app->request->queryParams);
            $tours->query->where(['id_league' => $league->id, 'n_tour'=> $tour, 'id_season'=>$season])->andWhere(['not',['date_match'=> null]])->orderBy(['date_match' => SORT_ASC]);
            //$tours = $searchMatches->getTeams($league->id, $season, $tour);
        } else {
            $searchTours = new TournamentSearch();$tours = $searchTours->search(Yii::$app->request->queryParams);
            $tours->query->andWhere(['id_league' => $league->id, 'n_tour'=> $tour, 'id_season'=>$season])/*->andWhere(['id_group' => 1])*/;/*$tours->pagination->pageSize=4;*/ $tours->totalCount=1;
        }

        $searchTeam = new PlayersSearch(); $team = $searchTeam->search(Yii::$app->request->queryParams);
        $searchEvents = new NewsSearch(); $events = $searchEvents->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'matches' => $matches,
            'tours' => $tours,
            'team' => $team,
            'events' => $events,
            'league' => $league,
            'tour' => $tour,
            'season' => $season
        ]);
    }

}