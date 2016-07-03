<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use backend\models\Matches;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$name_t = [
    '2' => ['1 тур', '2 тур', 'Полуфинал', 'Финал'],
    '4' => ['Полуфинал', '3 место', 'Финал'],
];
//print_r(Yii::$app->request->get('league'));
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
//$ar = Matches::find()->joinWith('idLeague')/*->where(['league.current' => 1])->groupBy('id_league')*/->all();
$m = new \backend\models\MatchesSearch();
//print_r($ar);
?>
<div class="site-about">
    <?php $form = ActiveForm::begin(['action' => 'tournament','method' => 'get']); ?>
        <?= Html::dropDownList('season', '2', ArrayHelper::map($m->dataList(), 'id_season', 'idSeason.year'),['class' => 'form-control']) ?>
    <?php ActiveForm::end(); ?>
    <?php
    $itemsUl = [];
    foreach ($m->dataList() as $model):
        if(array_key_exists($model->id_league, $name_t)) {
            $itemLi = ['label' => $name_t[$model->id_league][$model->n_tour - 1], 'url' => ['/pages/tournament', 'league' => $model->id_league, 'tour' => $model->n_tour, 'season' => $model->id_season]];
        } else {
            $itemLi = ['label' => $model->n_tour.' тур', 'url' => ['/pages/tournament', 'league' => $model->id_league, 'tour' => $model->n_tour, 'season' => $model->id_season]];
        }
        array_push($itemsUl, $itemLi);
    endforeach;
    echo Menu::widget([
        'items' => $itemsUl,
        'itemOptions' => ['class' => 'list-group-item'],
        'activeCssClass'=>'active',
        'options' => [
            'class' => 'list-group months text-uppercase',
        ]
    ]);
    ?>
    <code><?= __FILE__ ?></code>
</div>
