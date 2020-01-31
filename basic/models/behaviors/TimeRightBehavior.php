<?php


namespace app\models\behaviors;


use yii\base\Behavior;

class TimeRightBehavior extends Behavior
{

   public function run($timeString)
    {
        /*
        $time = explode(' ', $timeString);
        $timedate = explode('-', $time[0]);
        $time[0] = implode('-', array_reverse($timedate));
        return implode('T', $time);
        */
        
        return str_replace(' ', 'T', $timeString);
        
    }
}