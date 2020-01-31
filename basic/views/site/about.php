<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model[title];'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=$model[content]?></p>
</div>
