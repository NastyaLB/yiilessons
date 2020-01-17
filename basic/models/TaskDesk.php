<?php

namespace app\models;
use yii\base\Model;

class TaskDesk extends Model {
    
    //public $conTitle;
    
    
    
    public function TDform() {
        $id = \Yii::$app->request->get('id');
        
        
        $taskdb = [
            '0' => ['id'=>'1','tasktext'=>'Установить фреймворк. Проверить работоспособность демонстрационного приложения.','status'=>'1'],
            '1'=>['id'=>'2','tasktext'=>'Сделать собственный контроллер с двумя экшенами - просмотр списка задач и просмотра карточки отдельной задачи. Пока на каждой странице выводить текст с кратким описанием того, что будет на этой странице в дальнейшем.','status'=>'1'],
            '2'=>['id'=>'3','tasktext'=>'Создать свой собственный валидатор как отдельный класс','status'=>'0']
        ];
        
        
        if($id == 1) {
            $taskdb0['0'] = $taskdb[$id-1];
            $conTitle = ['title' => 'Задача1', 'content' => $this->readTask($taskdb0)];            
        } elseif($id == 2) {
            $taskdb0['0'] = $taskdb[$id-1];
            $conTitle = ['title' => 'Задача2', 'content' => $this->readTask($taskdb0)];            
        } elseif($id == 3) {
            $taskdb0['0'] = $taskdb[$id-1];
            $conTitle = ['title' => 'Задача3', 'content' => $this->readTask($taskdb0)];            
        } else {
            $conTitle = ['title' => 'Список задач', 'content' => $this->readTask($taskdb)];
        } 
        
        return $conTitle;
    } 
    
   public function readTask($taskdb) {
       
       $conTitle = '<form action="" method="post"><ol';
       if(count($taskdb) == 1) {
           $conTitle .= ' start="';
           $conTitle .= $taskdb['0']['id'];
           $conTitle .= ' start="';
       }
       $conTitle .= '>';
       
       foreach($taskdb as $k => $m) {
               $conTitle .= '<li>';
               $conTitle .= $m['tasktext'];
               $conTitle .= $nbd;
               $conTitle .= ' <input type="checkbox" ';
               if($m['status'] == 1) $conTitle .= 'checked';  
           
               if(count($taskdb) > 1){
                   $conTitle .= '> <a href="index.php?r=task&id='; 
                   $conTitle .= $taskdb[$k]['id']; 
                   $conTitle .= '">Перейти...</a';
               }
               $conTitle .= '></li>'; 
       }
       
       $conTitle .= '</ol></form>';
       return $conTitle;
   }
    
}