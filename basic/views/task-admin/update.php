<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\TaskDB */

$this->title = 'Update Task Db: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Task Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-db-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
