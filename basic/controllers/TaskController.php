<?php

namespace app\controllers;

use app\models\Lesson;
use app\models\TaskDesk;
use yii\web\Controller;
use yii\db\ActiveRecord;

class TaskController extends Controller
{
        
    public function actionIndex() {        
        
        $model = new TaskDesk();
        
        return $this->render('tasks',$model->TDform()); 
    }
    
    
    
    //пример своей валидации с урока
    public function actionLesson1() {        
        
        $model = new Lesson();
        $model->name = 'Lesson1';
        $model->description = 'Lesson1';
        $model->order = 4;        
        
        if(!$model->validate()) {
            var_dump($model->getErrors());exit();
        } else var_dump($model->validate());exit();
    }
    
}