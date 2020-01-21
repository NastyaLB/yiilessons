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
 * @property string creatorName
 * @property string responsibleName
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
            [['deadline'], 'safe'],
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
            'title' => 'Title',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'responsible_id' => 'Responsible ID',
            'deadline' => 'Deadline',
            'status_id' => 'Status ID',
        ];
    }
    
    //
    public function getStatus(){
        return 'stub';
        
       // return Sthis->hasOne(TaskDB::class, ['id' => 'status_id']);
    }
    //
    
    //передача имени создателя задачи
    public function getCreatorName(){
        
        $result = $this->hasOne(UsersDB::class, ['id' => 'creator_id'])->scalar(); 
        return UsersDB::find()->select(['name'])->where("id = $result")->scalar();
    }
    //передача имени исполнителя задачи
    public function getResponsibleName(){
        
        $result = $this->hasOne(UsersDB::class, ['id' => 'responsible_id'])->scalar(); 
        return UsersDB::find()->select(['name'])->where("id = $result")->scalar();
    }
    
}
