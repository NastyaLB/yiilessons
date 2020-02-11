<?php


namespace app\components;

use app\models\tables\TaskDB;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;


class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->setLang();
        $this->attachEventsHandlers();
    }
    
    protected function setLang() {
        if($lang = \Yii::$app->session->get('lang')){
            \Yii::$app->language = $lang;
        }
    }
    
    protected function attachEventsHandlers(){
        Event::on(TaskDB::class, TaskDB::EVENT_AFTER_INSERT, function(Event $event){
            /** @var Tasks $task */
            $task = $event->sender;
            $responsible = $task->responsible;
            \Yii::$app->mailer->compose()
                ->setTo($responsible->email)
                ->setFrom(['admin@site.ru'])
                ->setSubject('Новая задача')
                ->setTextBody(
                    "Уважаемый $responsible->name, вы назначены ответственным за вновьсозданную задачу «11»"
                ) //{$task->id}
                ->send();
        });
    }

}