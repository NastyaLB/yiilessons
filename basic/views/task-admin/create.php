<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\TaskDB */

$this->title = 'Create Task Db';
$this->params['breadcrumbs'][] = ['label' => 'Task Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-db-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
