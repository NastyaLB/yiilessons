<?php
namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\DetailView;


class Taskdbwidget extends Widget
{
    public $label;
    public $linky;
    public $attr;
    
    
    public function run()
    { 
        return $this->render('my-task-layout', [ 'label' => $this->label, 'link' => $this->linky, 'attr' => $this->attr,  ]); 
        
    }
}
