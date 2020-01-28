<?php


namespace app\models\events;


use yii\base\Event;

class UserSucsavedEvent extends Event
{
    public $userId;
}