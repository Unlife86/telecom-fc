<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Tournament */

$this->title = 'Create Tournament';
$this->params['breadcrumbs'][] = ['label' => 'Tournaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tournament-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?php
/*array_keys($model->attributes)*/;
$script = <<< JS
$('#tournament_id').change( function() {
    var id = $(this).val();
    $.get('index.php?r=tournament%2Fdata-tournament-team', {id:id}, function(data) {
        data = $.parseJSON(data);
        console.log(data);
        var keys = Object.keys(data);
        for (var i = 0; i < keys.length; i++) {
            $('input#tournament-' + keys[i]).attr('value', keys[i] == 'n_tour' ? data[keys[i]] + 1 : data[keys[i]]);
        } 
        $('#tournament_id option[value =' + data['id'] + ']').attr('value', data['id_team']);
    });
});
JS;
$this->registerJs($script);
?>