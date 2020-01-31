<?php


namespace app\models\behaviors;


use yii\base\Behavior;

class MonthBetweenBehavior extends Behavior
{

   public function run($month)
    {
       $monthes = [
           '1'=>['2020-01-01','2020-01-31'],
           '2'=>['2020-02-01','2020-02-29'],
           '3'=>['2020-03-01','2020-03-31']];
        /*
        $time = explode(' ', $timeString);
        $timedate = explode('-', $time[0]);
        $time[0] = implode('-', array_reverse($timedate));
        return implode('T', $time);
        */
        
        return $monthes[$month];
        
    }
}