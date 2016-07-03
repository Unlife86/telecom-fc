<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TournamentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Pjax::begin();
$this->title = $dataProvider->getModels()[0]->idLeague->name.': Турнирная таблица';
$this->params['breadcrumbs'][] = $this->title;
/*$data = []; $models = $dataProvider->models;
foreach($models as $model):
    array_push($data, ArrayHelper::toArray($model,[
        'common\models\Tournament' => [
            'id_league',
        ],
    ], false));
endforeach;
print_r(ArrayHelper::map($data,'id_league','id_league'));*/print_r(Yii::$app->request->queryParams);
?>
<div class="tournament-index">
<?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
<ul class="list-inline">
<li>
    <?= Html::button('Добавить тур',['value' => Url::to('index.php?r=tournament/create'),'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
</li>
<li>
    <?= Html::activeDropDownList($searchModel,'id_league', ArrayHelper::map($searchModel->Leagues(), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Выберите турнир']) ?>
</li>
<li>
    <?= Html::activeDropDownList($searchModel,'id_group', ArrayHelper::map($searchModel->RegionGroup(Yii::$app->request->queryParams['TournamentSearch']['id_league']), 'id_group', 'idGroup.name_group'), ['class' => 'form-control', 'prompt' => 'Выберите группу']) ?>
</li>
<li>

</li>

</ul>
<?php
Modal::begin([
    'header' => '<h4>Tournament</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo '<div id="modalContent"></div>';
Modal::end();
//print_r(Yii::$app->request->queryParams['TournamentSearch']['id_league']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'filterSelector' => '#tournamentsearch-id_league, #tournamentsearch-id_group',
    'summary' => '',
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Позиция',
            'value' => 'positon_in_tour',
        ],
        [
            'label'=>'Команда',
            'value'=> function($model) {
                return $model->idTeam->name_team .' ( '. $model->idTeam->city.')';
            },
            /*'filter' => Html::activeDropDownList(
                $searchModel,'id_team', ArrayHelper::map($dataProvider->getModels(), 'id_team', 'idTeam.name_team'), ['class' => 'form-control', 'prompt' => 'Выберите команду']
            ),*/
                ],
                [
                    'label' => 'Игры',
                    'value' => 'plays',
                ],
                [
                    'label' => 'Победы',
                    'value' => 'c_wins',
                ],
                [
                    'label' => 'Ничьи',
                    'value' => 'c_dead_heat',
                ],
                [
                    'label' => 'Пораж.',
                    'value' => 'c_loses',
                ],
                /*[
                    'label'=>'Мячи',
                    'value' => function($model) {
                        return $model->scored_goals .' - '. $model->conceded_goals;
                    }
                ],*/
                [
                    'label' => 'Заб. мячи',
                    'value' => 'scored_goals',
                ],
                [
                    'label' => 'Пропущ. мячи',
                    'value' => 'conceded_goals',
                ],
                [
                    'label' => 'Очки',
                    'value' => 'current_point',
                ],
                /*[
                    'attribute'=>'id_league',
                    'value'=>'idLeague.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,'id_league', ArrayHelper::map($searchModel->Leagues(), 'id', 'name'), ['class' => 'form-control']
                    ),
                ],*/
                /*[
                    'attribute'=>'id_group',
                    'value'=>'idGroup.name_group',
                    'filter' => Html::activeDropDownList(
                        $searchModel,'id_group', ArrayHelper::map($searchModel->search('TournamentSearch[id_league]')->getModels(), 'id_group', 'idGroup.name_group'), ['class' => 'form-control', 'prompt' => 'All']
                    ),
                ],*/
                [
                    'attribute'=>'id_season',
                    'value'=>'idSeason.year',
                ],
                'n_tour',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    Pjax::end(); ?>
</div>
