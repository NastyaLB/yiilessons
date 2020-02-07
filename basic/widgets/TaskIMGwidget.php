<?php
namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\DetailView;


class TaskIMGwidget extends Widget
{
    public $linky;
    
    
    public function run()
    { 
        return $this->render('one-task-image', ['link' => $this->linky ]);
    }
}
