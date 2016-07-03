<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypePublish */

$this->title = 'Update Type Publish: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Type Publishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-publish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
