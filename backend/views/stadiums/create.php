<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stadiums */

$this->title = 'Create Stadiums';
$this->params['breadcrumbs'][] = ['label' => 'Stadiums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stadiums-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
