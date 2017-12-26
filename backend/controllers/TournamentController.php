<?php

namespace backend\controllers;

use Yii;
use common\models\Tournament;
use backend\models\TournamentSearch;
use yii\base\Model;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * TournamentController implements the CRUD actions for Tournament model.
 */
class TournamentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TournamentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => ': Турнирная таблица',
            'columns' => $searchModel->columns(),
            'toolbarContent' => $searchModel->toolbarContent()
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Tournament();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'TournamentSearch' => ['id_league' => $model->id_league, 'id_season' => $model->id_season, 'n_tour' => $model->n_tour - 1]]);
        } else {
            if (isset(Yii::$app->request->queryParams[$model->formName().'Search'])) {$model->setAttributes(Yii::$app->request->queryParams[$model->formName().'Search']);} 
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tournament::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDataTournamentTeam($id)
    {
        if (($model = Tournament::find()->andFilterWhere(['id_team' => $id])->orderBy(['id' => SORT_DESC])->one()) !== null) {
            echo Json::encode($model);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
