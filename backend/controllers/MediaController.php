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
    }

    public function actionDelete($id)
    {
    }
}
