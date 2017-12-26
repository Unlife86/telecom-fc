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
    
    public function actionIndex()
    {
        $array_return = ['league' => $league = Yii::$app->currentFootballData->getCurrentLeague()];
        $params = [
            'id_season' => $season = Yii::$app->currentFootballData->getCurrentSeason($league->id),
            'id_league' => $league->id,
        ];
        $n_tour = Yii::$app->currentFootballData->getCurrentTour($season, $league->id);
        $searchMatches = new MatchesSearch();
        $rounds = $searchMatches->getTours(['MatchesSearch' => $params]);
        $matches = []; $matchesProvider = $searchMatches->search(['MatchesSearch' => array_merge($params,['n_tour' => null, 'date_match' => null])]);
        $matches_models = ArrayHelper::index($matchesProvider->models, null, 'n_tour');
        foreach ($rounds as $round):
            if (isset($matches_models[$round->n_tour])) {$matchesProvider->setModels($matches_models[$round->n_tour]);
            array_push($matches, clone $matchesProvider);}
        endforeach;
        $array_return = array_merge($array_return,['matches' => $matches]);
        if ($league->type != 'play-off') {
            $searchTournament = new TournamentSearch(); $tournament = $searchTournament->search(['TournamentSearch' => array_merge($params, ($league->type == 'group') ? ['n_tour' => $n_tour, 'id_group' => 1] : ['n_tour' => $n_tour])]);
            $tournament->totalCount=1;
            $array_return = array_merge($array_return,['tournament' => $tournament/*, 'headers' => $headers = ['Матчи в туре', 'Ближайшие матчи']*/]);
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