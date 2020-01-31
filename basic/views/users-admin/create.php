<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\UsersDB */

$this->title = 'Create Users Db';
$this->params['breadcrumbs'][] = ['label' => 'Users Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-db-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
