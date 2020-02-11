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
use yii\caching\TagDependency;
use yii\web\UploadedFile;

class TaskController extends Controller
{
        
    public function actionIndex() {
        
        $model = new Tasksdbfilter();
        
        $cache = \Yii::$app->cache;
        $dataProvider = $model->search(\Yii::$app->request->queryParams);
        
        $month = (int)\Yii::$app->request->get('month');
        $tag = 'task-' . $month; // тэг        
        $timel = 60;  // время жизни тэга
        
        Yii::$app->db->cache(function() use ($dataProvider) {return $dataProvider->prepare();}, $timel, new TagDependency(['tags' => $tag]) ); // Пометка тэгом кеша
        
        TagDependency::invalidate(Yii::$app->cache,$tag); // Очистка всех кешей с данным тэгом
        
        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
        
    }
        
    public function actionPage() { 
        $model = new TaskModifyForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->createTask()) {
            $model->newfile = UploadedFile::getInstances($model, 'newfile');
            $model->save();
            return $this->goBack('');
        } else  $model->createTask();
        
        
        return $this->render('taskpage',['model' => $model]);
    }
    
     
    public function actionInfo(){
        echo 'Раздел помощи';
    }
}