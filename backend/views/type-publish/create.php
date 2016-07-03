<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypePublish */

$this->title = 'Create Type Publish';
$this->params['breadcrumbs'][] = ['label' => 'Type Publishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-publish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
