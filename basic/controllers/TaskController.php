<?php

namespace app\controllers;

use Yii;
use app\models\Lesson;
use app\models\filters\Tasksdbfilter;
use app\models\TaskModifyForm;
use app\models\events\TaskSuccessfullySavedEvent;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\base\Event;
use app\models\tables\TaskDB;

class TaskController extends Controller
{
        
    public function actionIndex() { 
        
        $model = new Tasksdbfilter();
        
        //кэширование по месяцам
        if($month = (int)\Yii::$app->request->get('month')) {
            $cache = \Yii::$app->cache;
            
            $key = dataProvider.$month;
            if($cache->exists($key)) {
                $dataProvider = $cache->get($key);
            } else {
                $dataProvider = $model->search(\Yii::$app->request->queryParams);
                $cache->set($key, $dataProvider, 30); 
            }
        } else $dataProvider = $model->search(\Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
        
    }
        
    public function actionPage() { 
        
        $model = new TaskModifyForm();  
        
        //$model->on(TaskModifyForm::EVENT_TASK_SUCCESSFULLY_SAVED, $handler, '$model->responsible_id'); 
        
        if ($model->load(Yii::$app->request->post()) && $model->createTask()) {
            return $this->goBack();//goHome();
        } else  $model->createTask();
        
        
        return $this->render('taskpage',['model' => $model]);
    }
    
     
    public function actionInfo(){
        echo 'Раздел помощи';
    }
}