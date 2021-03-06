<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\tables\TaskDB;
use app\models\tables\UsersDB;
use app\models\behaviors\TimeRightBehavior;
use app\models\behaviors\TranslitBehavior;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * ContactForm is the model behind the contact form.
 */
class TaskModifyForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $creator_id;
    public $responsible_id;
    public $deadline;
    public $starttime;
    public $modifytime;
    public $status_id = 0;
    public $status;
    public $responsible;
    public $responsible_list;
    public $creator;
    public $newfile;
    public $urlimg;
    public $messageTOuser;
    
    const EVENT_TASK_SUCCESSFULLY_SAVED = 'event_task_successfully_saved';
    
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'description', 'creator_id', 'responsible_id', 'deadline', 'modifytime'], 'required'],
            [['newfile'], 'file',  'extensions' => 'jpg, png', 'maxFiles' => 0],//'skipOnEmpty' => false, 
        ];
    }

    public function createTask()
    {
        $id = (int)\Yii::$app->request->get('id');
        
        if ($id && $taskdb = TaskDB::findOne(['id' => $id])) {
            
            if( $taskdb->modifytime != $this->modifytime && !empty($this->modifytime)) {
                
                $taskdb->title = $this->title;
                $taskdb->description = $this->description;
                $taskdb->responsible_id = $this->responsible_id;
                $taskdb->modifytime = $this->modifytime;
                $taskdb->deadline = $this->deadline; 
                $taskdb->save();
                
            } else  {
                
                $this->id = $id;
                $this->title = $taskdb->title;
                $this->description = $taskdb->description;
                $this->creator_id = $taskdb->creator_id;
                $this->creator = $taskdb->creator;
                $this->responsible_id = $taskdb->responsible_id;
                
                $starttime = TimeRightBehavior::run($taskdb->starttime);
                $this->starttime = $starttime;
                $modifytime = TimeRightBehavior::run($taskdb->modifytime);
                $this->modifytime = $modifytime;
                $deadline = TimeRightBehavior::run($taskdb->deadline);
                $this->deadline = $deadline;
                $this->status_id = $taskdb->status_id;
                
                $path = '..\upload\files\small';
                $this->urlimg = BaseFileHelper::findFiles ($path, ['filter'=> function ($path) {
                    $urlTitle = TranslitBehavior::run($this->title);
                    return stristr($path, $urlTitle);} ]);
                //var_dump($this->urlimg);
            }
            $this->messageTOuser = 'Вы просматриваете и можете изменить информацию по задаче: '.$this->title;
            
        } elseif (!$taskdb = TaskDB::findOne(['title' => $this->title])) {
            
            if(!empty($this->title) && !empty($this->description) && !empty($this->responsible_id) && !empty($this->deadline)) {
                $taskdb = new TaskDB([
                    'title'  => $this->title,
                    'description' => $this->description,
                    'creator_id' => $_SESSION[__id],
                    'responsible_id' => $this->responsible_id,
                    'starttime' => $this->modifytime,
                    'modifytime' => $this->modifytime,
                    'deadline' => $this->deadline,
                    'status_id' => '0',
                ]);
                
                                
                $taskdb->save();
                $this->trigger(static::EVENT_TASK_SUCCESSFULLY_SAVED, $event);
            }
            $this->messageTOuser = 'Сформируйте свою задачу: ';
        }  
        
        //выпадающий список ответственных
        $res_list0 = \Yii::$app->db->createCommand('select name from usersdb')->queryColumn();
        foreach($res_list0 as $k => $m) {
            $res_list[$k+1] = $m;
        }
        $this->responsible_list = $res_list;
        //конец фомирования списка ответственных
        
        return $taskdb;
        
    }
    
    //название поля картинок
    public function attributeLabels()
    {
        return [
            'newfile' => Yii::t('app', 'newfile'),//'Прикрепленные файлы',
        ];
    }
    
    //сохранение картинки. Сохраняет картинку по названию(title) Задачи с нумерацией
    public function save() 
    { 
        $newtitle = TranslitBehavior::run($this->title);
        
        $path = '..\upload\files\small';
        $imgcount = BaseFileHelper::findFiles ($path, ['filter'=> function ($path) {
                    $urlTitle = TranslitBehavior::run($this->title);
                    return stristr($path, $urlTitle);} ]);
        $count = count($imgcount)+1;
        foreach($this->newfile as $keyfile) {
            $filepath = \Yii::getAlias("@upfiles/big/{$newtitle}___{$count}.{$keyfile->extension}"); //@app/upload/files/big/
            
            $thumbpath = \Yii::getAlias("@upfiles/small/{$newtitle}___{$count}.{$keyfile->extension}"); 
            $keyfile->saveAs($filepath);
            
            Image::thumbnail(\Yii::getAlias($filepath), 100,100)->save($thumbpath);
            
            $count++;            
        }        
    }
}
