<?php

namespace app\controllers;

use Yii;
use app\models\Lesson;
use app\models\filters\Tasksdbfilter;
use yii\web\Controller;
use yii\db\ActiveRecord;

class TaskController extends Controller
{
        
    public function actionIndex() {   
        
        $model = new Tasksdbfilter();
        $dataProvider = $model->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,]);
    }
    
     
    public function actionInfo(){
        echo 'Раздел помощи';
    }
}