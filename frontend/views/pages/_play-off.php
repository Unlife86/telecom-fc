<?php

use yii\grid\GridView;
use yii\helpers\Html;

if ($current['id_league'] == 2) {
    $rounds = ['1/8 финала', '1/4 финала', 'Полуфинал', 'Финал'];
    $height = 784;
} else if ($current['id_league'] == 4) {
    $rounds = ['Полуфинал', 'за 3 место', 'Финал'];
    $height = 246;
}
?>
<table style="width: 100%;" class="rounds">
    <thead>
        <?php foreach ($rounds as $round):
            echo '<th class="text-center col-xs-'.(12 / count($rounds)).'">'.$round.'</th>';
        endforeach; ?>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($rounds as $key => $value):
                if (($rounds[$key] == 'Полуфинал') and ($key < count($rounds)))  {
                    if ($rounds[$key + 1] == 'за 3 место') {
                        echo '<td class="col-xs-'.(12 / count($rounds)).' third-place">';
                    } else {
                        echo '<td class="col-xs-'.(12 / count($rounds)).'">';
                    }
                }
                else {
                    echo '<td class="col-xs-'.(12 / count($rounds)).'">';
                }
            ?>
                <?php
                if(array_key_exists($key, $tournament)) {
                    echo GridView::widget([
                        'options' => ['class'=>'reset-margin'],
                        'summary'=>'',
                        'dataProvider' => $tournament[$key],
                        'tableOptions' => ['class' => 'playoff', 'style' => 'height: '.$height.'px'],
                        'showHeader' => false,
                        'columns' => [
                            [
                                'format' => 'html',
                                'value'=> function($model) {
                                    $home = ['name' => '', 'city' => null]; $guest = ['name' => '', 'city' => null];
                                    if ($model->id_home != 0) {$home['name'] = $model->idHome->name_team; $home['city'] = $model->idHome->city;}
                                    if ($model->id_guest != 0) {$guest['name'] = $model->idGuest->name_team; $guest['city'] = $model->idGuest->city;}
                                    $teams = Html::tag('div',Html::tag('p', $home['name'],['class' => 'bold']).Html::tag('p', $guest['name'],['class' => 'bold']),['class' => 'col-xs-9']);
                                    if (count($model->score_h) == 0) {
                                        if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
                                            $result = Html::tag('div',Html::tag('p', date('d.m',strtotime($model->date_match)),['class' => 'date']),['class' => 'col-xs-3']);
                                        } else if (!empty($model->date_match)) {
                                            $result = Html::tag('div',Html::tag('p', date('d.m H:i',strtotime($model->date_match)),['class' => 'date']),['class' => 'col-xs-3']);
                                        } else {
                                            $result = Html::tag('div',Html::tag('p', '',['class' => 'date']),['class' => 'col-xs-3']);;
                                        }
                                    } else {
                                        $result = Html::tag('div',Html::tag('p', $model->score_h.' : '.$model->score_g,['class' => 'score'])/*.Html::tag('p', $model->score_g,['class' => ''])*/,['class' => 'col-xs-3']);
                                    }

                                    return $teams.$result;
                                }
                            ],
                        ],
                    ]);
                }
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>
<?php
foreach ($tournament as $tour):
    $model = $tour->getModels();
   // if () {

        $caption = $model[0]->n_tour;
        echo $this->render('_matches', ['dataProvider' => $tour, 'caption' => $rounds[$caption - 1]]);
    //}

endforeach;
?>



