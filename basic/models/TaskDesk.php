<?php

namespace app\models;
use yii\base\Model;
use app\models\tables\TaskDB;
use app\models\tables\UsersDB;
use yii\data\ActiveDataProvider;

class TaskDesk extends Model {
    
    //public $conTitle;
    
    
    //формирование вывода страницы задач, передача ID для формирования контента в readTask
    public function TDform() {
        $id = (int)\Yii::$app->request->get('id');
        
        if(isset($id) && is_int($id)) {
            $conTitle = $this->readTask($id);            
        } else {
            $conTitle = $this->readTask('All');
        }
        $content = ['title' => $conTitle[title], 'content' => $conTitle[content]];
        
        return $content;
    }
    
        
    //формирование контента страницы задач или страницы задачи
   public function readTask($id) {
       
       //получение данных из БД yiilessons
       $taskDB = TaskDB::sampleDB($id); 
       
       //если $id какой-то не существующий, пустая страница
       if($taskDB[noid] == [$id]) {
           $content = '<p><a position:relative;bottom:0;right:0" href="index.php?r=task">Вернуться...</a></p>';
           $conTitle = ['title'=>'Нет такой задачи', 'content' => $content];
           return $conTitle; 
           exit;
       }
       //получение верстки вывода для страницы tasks
       $layout = $this->writeLayout($id);
       
       
       //склейка данных и верстки в зависимости от того, все задачи нужно вывести или одну
       if($id == 'All') {
           $content= $layout[0];
           foreach($taskDB as $k => $m) {
               $layoutStick = $layout[1] . $m[title] . $layout[2] . $m[description] . $layout[3] . $m[creator] . $layout[4] . $m[respon_name] . $layout[5] . $m[deadline] . $layout[6];
               
               if($m[status_id] == 1) $layoutStick .= $layout[7];
               
               $layoutStick .= $layout[8];
               $layoutStick .= $m[id];
               $layoutStick .= $layout[9];
               
               $content.= $layoutStick;
           } 
           $content.= $layout[10]; 
           
           $conTitle = ['title'=>'Список задач', 'content' => $content];
       } else {
           $content = $layout[0] . $layout[1] . $layout[2] . $taskDB[1][description] . $layout[3] . $taskDB[1][creator] . $layout[4] . $taskDB[1][respon_name] . $layout[5] . $taskDB[1][deadline];
           
           $layoutStick .= $layout[6];
           if($taskDB[1][status_id] == 1) $layoutStick .= $layout[7];
           
           $layoutStick .= $layout[8];
           $layoutStick .= $layout[9];
               
           $content.= $layoutStick; 
           $content.= $layout[10];
           
           $conTitle = ['title' => $taskDB[1][title], 'content' => $content];
       }       
                     
       return $conTitle;
   }    

   
    //формирование верстки
   public function writeLayout($id) {
       
       $layout = [
           '0' => '<div style="display: flex; justify-content: space-between;flex-wrap: wrap;">',
           '1' => '<div style="display:block;width:300px;height: 300px; box-shadow: 1px 1px 5px gray;padding: 5px;position: relative;color: #777777; margin-bottom:15px;"><h3>',
           '2' => '</h3><p>',
           '3' => '<br><small>Создатель: ',
           '4' => '<br>Исполнитель: ',
           '5' => '<br>Дедлайн: ',
           '6' => '.</small></p><form method="post"><input type="checkbox"',
           '7' => ' checked',
           ];
       
       if($id == 'All') {
           $layout[8] = '></form><a class="gogolink" style="display:block;width:300px;height: 300px; position:absolute;bottom:0;left:0" href="index.php?r=task&id='; 
           $layout[9] = '"></a><a position:relative;bottom:0;right:0" href="index.php?r=task">Перейти...</a></div>';
       } else {
           $layout[8] = '></form><a position:relative;bottom:0;right:0" href="index.php?r=task">';
           $layout[9] = 'Вернуться...</a></div>';
       }
       $layout[10] = '</div>';
       
       return $layout;
   }
    
}