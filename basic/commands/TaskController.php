<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\tables\UsersDB;
use app\models\tables\TaskDB;
use app\components\Bootstrap;


class TaskController extends Controller {
    
    public $message;// = 'Hello, '
    
    public function actionTest($id, $message) {
        
        if($user = UsersDB::findOne($id)) echo $message.$user->login;
        else echo $message.'UNKNOWN.';
    }
    
    public function actionExpire() {
        
        $task = TaskDB::find()->where('deadline >= now() - INTERVAL 1 DAY')->all(); 
        
        foreach($task as $k) {
            echo 'send to: '.$k->responsible->email.'. subject: дедлайн! text: Уважаемый '.$k->responsible->name.', срок сдачи задания '.$k->title.' истекает завтра.'.\r\n;/*
            \Yii::$app->mailer->compose()
                ->setTo($k->responsible->email)
                ->setFrom(['admin@site.ru'])
                ->setSubject('Дедлайн!')
                ->setTextBody(
                    "Уважаемый $k->responsible->name, срок сдачи задания истекает завтра"
                ->send();*/
        }
    }
    
    public function options($actionID) {
        return ['message'];
    }
    
    public function optionAliases()
    {
        return [
            'me' => 'message'
        ];
    }
    
    public function actionSeq()
    {
        $total = 100;
        Console::startProgress(0, $total);
        for ($i = 1; $i <= $total; $i++){
           Console::updateProgress($i, $total);
            sleep(1);
        }
        Console::endProgress();
    }
}