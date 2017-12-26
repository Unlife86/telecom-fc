<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
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
            $array_return = array_merge($array_return,['headers' => $headers = $league->id/2 == 1 ? [/*'1/8 финала', */'1/4 финала', 'Полуфинал', 'Полуфинал: Ответные матчи', 'Финал'] : ['Полуфинал', '3 место', 'Финал']]);
        }
        $searchTeam = new PlayersSearch(); $team = $searchTeam->search(Yii::$app->request->queryParams);
        $searchEvents = new NewsSearch(); $events = $searchEvents->search(Yii::$app->request->queryParams);
        $array_return = array_merge($array_return,[
            'team' => $team,
            'events' => $events,
            'pictures' => Yii::$app->media->find('/img/gallery/'),
            'params' => array_merge($params,['n_tour' => $n_tour]),
        ]);
        return $this->render('index', $array_return);
    }

}