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

class TaskController extends Controller
{
        
    public function actionIndex() { 
        
        $model = new Tasksdbfilter();
        
        $dataProvider = $model->search(\Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,]);
        
    }
        
    public function actionPage() { 
        
        /// непонятно как передать id
        $handler = function(Event $event){
            TaskSuccessfullySavedEvent::contact($event);
            return $this->goHome();
        } ; 
        
        /*
        $handler = function(Event $event){
            var_dump($event);
            echo'|||||Пользователь подписан на рассылку!';
        } ; 
        */
        $model = new TaskModifyForm();  
        
        $model->on(TaskModifyForm::EVENT_TASK_SUCCESSFULLY_SAVED, $handler, '$model->responsible_id'); 
        
        if ($model->load(Yii::$app->request->post()) && $model->createTask()) {
            //return $this->goHome();
        } else  $model->createTask();
        
        
        return $this->render('taskpage',['model' => $model]);
    }
    
     
    public function actionInfo(){
        echo 'Раздел помощи';
    }
}