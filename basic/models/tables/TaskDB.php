<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "taskDB".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $creator_id
 * @property int|null $responsible_id
 * @property string|null $deadline
 * @property int|null $status_id
 * @property string status
 * @property int|null $responsible
 * @property int|null $creator
 */

class TaskDB extends \yii\db\ActiveRecord
{



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taskDB';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['deadline', 'starttime', 'modifytime'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Имя задачи',
            'description' => 'Описание задачи',
            'creator_id' => 'Создатель задачи',
            'responsible_id' => 'Исполнитель задачи',
            'deadline' => 'Дедлайн',
            'status_id' => 'Status ID',
        ];
    }
    
    //
    public function getStatus(){
        return 'stub';
        
       // return $this->hasOne(TaskDB::class, ['id' => 'status_id']);
    }
    
    
    //получение заданий из базы
    public function sampleDB($id){
        
        $query = TaskDB::writeQuery($id);
        
        //получение данных из БД yiilessons
        $result = \Yii::$app->db->createCommand($query)->queryAll();
        
        //массив задач для вывода на страницу tasks
        foreach($result as $k => $m) {
            
            if( is_int(($k+2)/2) ) {
                $taskDB[($k+2)/2] = [
                    'id' => $m['id'],
                    'title' => $m['title'],
                    'description' => $m['description'],
                    'creator_id' => $m['creator_id'],
                    'creator' => $m['name'],
                    'deadline' => $m['deadline'],
                    'status_id' => $m['status_id'],
                ];
            } else {
                $taskDB[($k+1)/2][respon_id] = $m['responsible_id'];
                $taskDB[($k+1)/2][respon_name] = $m['name'];
            }
        }
        
        if(!isset($result[1])) {
            $taskDB[noid] = [$id];
        }
    
        return $taskDB; 
    }
    
    //получение mysql-запроса для базы
    public function writeQuery($id) {
        
        //формирование запроса $query для получения данных из БД yiilessons
        $query = 'select taskdb.id, taskdb.title, taskdb.description, taskdb.creator_id, usersdb.name, taskdb.responsible_id, usersdb.name, taskdb.deadline, taskdb.status_id from taskdb join usersdb on usersdb.id = taskdb.creator_id or usersdb.id = taskdb.responsible_id';
        if($id != 'All') {
            $query .= ' where taskDB.id = ';
            $query .= $id;
        }
        $query .= ' ORDER BY taskdb.id;';
        
        return $query;
    }
    
    
    //получение имени исполнителя задания
    public function getResponsible(){
        
        return $this->hasOne(UsersDB::class, ['id' => 'responsible_id']);
    }
    
    //получение имени создателя задания
    public function getCreator(){
        
        return $this->hasOne(UsersDB::class, ['id' => 'creator_id']);
    }
}
