<?php

namespace app\models;
use yii\base\Model;

class Lesson extends Model {
    public $name;
    public $description;
    public $order;
    
    public function rules() {
        return [
            [['name','description','order'],'required'],
            [['name','description'],'string'],
            [['order'], 'myValidate'],
        ];
    }
    
    public function myValidate($atributeName,$params) {
        if($this->$atributeName > 2) {
            $this->addError($atributeName,'More!');
        }
    }
}