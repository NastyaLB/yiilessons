<?php

namespace app\models;
use yii\base\Model;
use app\models\tables\TaskDB;
use app\models\tables\UsersDB;

class TaskDesk extends Model {
    
    //public $conTitle;
    
    
    //формирование вывода страницы задач, передача ID для формирования контента в readTask
    public function TDform() {
        $id = \Yii::$app->request->get('id');
        
        $ifID = \Yii::$app->db->createCommand("SELECT * FROM taskDb WHERE id=(:id);")->bindValues([':id' => $id])->queryScalar();
        
        if($ifID) {
            $ttask = 'Задача '.TaskDB::find()->select(title)->where("id = $id")->scalar();
            $conTitle = ['title' => $ttask, 'content' => $this->readTask($id)];        
        } else {
            $conTitle = ['title' => 'Список задач', 'content' => $this->readTask('All')];     
       }
        
        return $conTitle;
    } 
    
    //формирование контента страницы задач или страницы задачи
   public function readTask($id) {        
       $conTitle ='<form action="" method="post"><ol';
       
       if($id == 'All') {
           $taskDB = \Yii::$app->db->createCommand('SELECT * FROM taskdb;')->queryAll();
           $conTitle .= '>';
       }
       else {
           $taskDB = \Yii::$app->db->createCommand("SELECT * FROM taskdb where id = $id;")->queryAll();
           $conTitle .= ' start="';
           $conTitle .= $taskDB[0][id];
           $conTitle .= '">';
       }
       
       foreach($taskDB as $k => $m) {
           $d = substr($m[deadline], 0, -3);
           $conTitle .= '<li>';
           $conTitle .= $m[description];
           $conTitle .= '</br><small>Создатель: ';
           $conTitle .= TaskDB::findOne($m[creator_id])->creatorName;;
           $conTitle .= ' Исполнитель: ';
           $conTitle .= UsersDB::find()->select(name)->where("id = $m[responsible_id]")->scalar();
           $conTitle .= ' Дедлайн: ';
           $conTitle .= $d;
           $conTitle .= ' </small><input type="checkbox" ';
           if($m[status_id] == 1) $conTitle .= 'checked';
           $conTitle .= '><a href=index.php?r=task&id=';
           $conTitle .= $m[id];
           $conTitle .= '>Перейти...</a></li>';
       }
       $conTitle .= '</ol></form>';
       return $conTitle;
   }
    
}