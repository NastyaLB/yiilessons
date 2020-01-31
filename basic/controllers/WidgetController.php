<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\TaskDesk;
use app\models\Lesson;
use app\models\tables\TaskDB;
use app\models\tables\UsersDB;
use yii\db\ActiveRecord;

class WidgetController extends Controller
{
    
    //разные примеры
    public function actionIndex()    
    {
        //var_dump(\Yii::$app->request->post()); exit;
        $model = new TaskDB();
        return $this->render('indexTask', ['model' => $model]);
    }
}
