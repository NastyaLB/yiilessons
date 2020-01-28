<?php


namespace app\models\events;


use Yii;
use yii\base\Event;

class TaskSuccessfullySavedEvent extends Event
{
    //public $userId;
    public function run($event) {
        echo'111!';
    }
    
    public function contact($event)
    {
        /*
        Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo(['$this->email' => '$this->name'])
                ->setSubject('$this->subject')
                ->setTextBody('$this->body')
                ->send();

            return true;
            */
        
            return false;
    }
}