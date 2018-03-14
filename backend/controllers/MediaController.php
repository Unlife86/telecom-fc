<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MediaController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'media_files' => Yii::$app->media->find('pictures'),
        ]);
    }

    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            if (Yii::$app->media->upload('img/gallery/')) {
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('upload', ['model' => Yii::$app->media->model]);
    }

    public function actionDelete($id)
    {
    }
}
