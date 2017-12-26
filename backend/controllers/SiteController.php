<?php
namespace backend\controllers;

use backend\forms\LoginForm;
use backend\forms\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'ips' => ['127.0.0.1', '10.2.2.10', '10.2.2.3', '176.96.65.110'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'ips' => ['127.0.0.1', '10.2.2.10', '176.96.65.110'],
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
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }        

        $model = new SignupForm();

        if (array_key_exists($model->formName(), $params = Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax && $model->load($params)) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->signup($params)) {
                return $this->actionLogin();
            }
        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->actionLogin();
    }
}
