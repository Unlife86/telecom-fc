<?php

namespace backend\controllers;

use common\models\Seasons;
use Yii;
use yii\base\Model;
use backend\models\MatchesSearch;
use common\models\Matches;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class MatchesController extends Controller
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
        $searchModel = new MatchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
            $model = $this->findModel(Yii::$app->request->post('editableKey'));
            $searchModel->setOutput($editableColumns = current(Yii::$app->request->post('MatchesSearch')));            
            if ($model->load($editableColumns, '') && $model->save()) {                
                return Json::encode(['output' => $searchModel->output, 'message' => '']);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => ': Матчи',
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
        $model = new MatchesSearch();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new MatchesSearch();
        }
        $model->load(Yii::$app->request->queryParams);
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = Matches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
