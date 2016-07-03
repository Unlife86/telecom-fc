<?php
namespace frontend\controllers;

use Yii;
use frontend\models\PlayersSearch;
use common\models\Players;
use frontend\models\NewsSearch;
use common\models\News;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
/**
 * Site controller
 */
class TeamController extends Controller
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
    public function getFullTeam() {
        $searchTeam = new PlayersSearch();
        $team = $searchTeam->search(Yii::$app->request->queryParams);
        return $team;
    }
    public function getFullEvents() {
        $searchEvents = new NewsSearch();
        $events = $searchEvents->search(Yii::$app->request->queryParams);
        return $events;
    }
    public function actionPlayer($id_player = null) {
        if ($id_player == null) {$id_player = 1;}
        return $this->render('player', [
            'team' => $this->getFullTeam(),
            'player' => $this->findModel($id_player),
        ]);
    }
    public function actionIndex($id_player = null) {
        if ($id_player == null) {
            return $this->render('index', [
                'team' => $this->getFullTeam(),
            ]);
        } else {
            return $this->render('player', [
                'team' => $this->getFullTeam(),
                'player' => $this->findModel($id_player),
            ]);
        }

    }
    public function actionEvents($year = null, $lastDate = null, $id_event = null) {
        $events = $this->getFullEvents();
        $db = Yii::$app->currentFootballData->getDsnAttribute('dbname', Yii::$app->getDb()->dsn);
        if ($id_event == null) {
            if ($year == null) {
                $year = News::find()->select('date_event')->max('date_event');
            }
            $year = Yii::$app->formatter->asDate($year, 'php:Y');
            $sql = 'SELECT date_event, COUNT(*) FROM '.$db.'.news WHERE date_event LIKE "'.$year.'%" GROUP BY MONTH(date_event) ORDER BY date_event ASC';
            $month = Yii::$app->db->createCommand($sql)->queryAll();
            $years = Yii::$app->db->createCommand('SELECT YEAR(date_event) FROM '.$db.'.news GROUP BY YEAR(date_event)')->queryAll();
            if ($lastDate == null ) { //current month in the year
                $lastDate = News::find()->select('date_event')->where(['like','date_event' ,$year])->max('date_event');
                $lastDate = Yii::$app->formatter->asDate($lastDate, 'php:Y-m');
            }
            $events->query->where(['like','date_event' ,$lastDate]); //list events on current month
            $response = ['listMonth' => $month, 'events' => $events, 'lastDate' => $lastDate, 'year' => $year, 'years' => $years];
            return $this->render('events', $response);
        } else {
            $event = News::findOne($id_event);
            $response = ['events' => $events, 'event' => $event];
            return $this->render('event', $response);
        }
    }
    /*public function actionEvent($id_event = null) {
        $events = $this->getFullEvents();

        $event = News::findOne($id_event);
        return $this->render('event', [
            'events' => $events,
            'event' => $event,
        ]);

    }*/
    protected function findModel($id)
    {
        if (($model = Players::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionVips() {
        return $this->render('vips');
    }
    public function actionAwards() {
        return $this->render('awards');
    }

}
