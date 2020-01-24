<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\tables\TaskDB;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TaskDBFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список задач';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-db-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Task Db', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'id',
            'title',
            'description',
            'creator_id',
            'responsible_id',
            //'deadline',
            //'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
        
       //echo \yii\widgets\listView::widget([ 'dataProvider' => $dataProvider, 'itemView' => 'view',  ]); //'viewParams' => [ 'hide' => true ],
    
    ?>


</div>
