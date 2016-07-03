<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'События';
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">События</h1>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li>События</li>
    </ul>
</header>
<div class="subsection bg-white">
    <div class="row">
        <div class="col-xs-9">
            <?= GridView::widget([
                'options' => ['class'=>'reset-margin'],
                'summary'=>'',
                'dataProvider' => $events,
                'tableOptions' => ['class' => 'table list-item', 'id' => 'table-list-match', 'style'=>'table-layout: fixed; margin-top: 0;'],
                'showHeader' => false,
                'columns' => [
                    [
                        'format'=>'html',
                        'value'=>function ($model) {
                            return Html::tag('p', Yii::$app->formatter->asDate($model->date_event, 'php:M'),['class'=> 'countdown-period']).Html::tag('p', Yii::$app->formatter->asDate($model->date_event, 'php:d'),['class'=> 'countdown-amount bg-black white-text']);
                        },
                        'contentOptions' => ['class'=>'col-xs-1'],
                    ],
                    [
                        'format'=>'html',
                        'value'=>function ($model) {
                            return Html::tag('div',Html::img(Yii::getAlias('@web').'/img/events/'. $model->id .'/main.jpg',['class'=>'img-responsive']),['class'=> 'wrap-img']);
                        },
                        'contentOptions' => ['class'=>'col-xs-2'],
                    ],
                    [
                        'value'=>'header_event',
                        'contentOptions' => ['class'=>'col-xs-3', 'style' => 'font-size: 16px; text-align: left;'],
                    ],
                    [
                        'format'=>'html',
                        'value'=>function ($model) {
                            $url = Url::to(['team/events', 'id_event'=>$model['id']]);
                            return Html::tag('a','Далее', ['class'=> 'btn btn-primary btn-more', 'href' => $url]);
                        },
                        'contentOptions' => ['class'=>'col-xs-2 text-uppercase'],
                    ],

                ],
            ]); ?>
        </div>
        <div class="col-xs-3">
            <?php $form = ActiveForm::begin(['action' => ['events'],'method' => 'get',]); ?>
                <?= Html::dropDownList('year', $year, ArrayHelper::map($years, 'YEAR(date_event)', 'YEAR(date_event)'),['class' => 'form-control', 'onchange'=>'this.form.submit()']);?>
            <?php ActiveForm::end(); ?>
            <ul class="list-group months text-uppercase cursor-pointer">
                <?php foreach ($listMonth as $month):
                        if (Yii::$app->formatter->asDate($month['date_event'], 'php:Y-m') == $lastDate) {
                            echo '<li class="list-group-item active">';
                        } else {echo '<li class="list-group-item">';} ?>
                            <?php $url = Url::to(['team/events', 'lastDate'=>Yii::$app->formatter->asDate($month['date_event'], 'php:Y-m')]);
                               echo Html::tag('a',Yii::$app->currentFootballData->getMonth($month['date_event']).' '.Html::tag('span',$month['COUNT(*)'],['class' => 'badge pull-right']), ['class'=> 'h5 bold', 'href' => $url]);?>
                        </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>