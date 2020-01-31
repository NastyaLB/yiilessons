<?php

namespace app\models;

//use Yii; ?
use app\models\behaviors\MyBehavior;
use app\models\events\UserSucsavedEvent;
use app\models\tables\UsersDB;
use app\models\LoginForm;
use yii\base\Model;

//use app\models\behaviors\MyBehavior;
//use app\models\events\UserSuccessfullySavedEvent;


/**
 * Авторизация
 *
 */
class RegForm extends Model
{
    public $id;
    public $name;
    public $username;
    public $password;
    public $confirm;
    public $email;
    public $rememberMe = true;
    public $messageTOuser = 'Please fill out the following fields to registrate:';

  /*  public function behaviors()
    {
        return [
            'my' => [
                'class' => MyBehavior::class,
                'message' => 'Привет!!!'
            ]
        ];
    }
*/

    const EVENT_USER_SUCCESSFULLY_SAVED = 'event_user_successfully_saved';
    const EVENT_USER_CREATE_START = 'user_create_start';
    const EVENT_USER_CREATE_COMPLETE = 'user_create_complete';

    public function createUser()
    {
        $this->trigger(static::EVENT_USER_CREATE_START);
        //echo "начало работы \<br>";
        if (!$user = UsersDB::findOne(['login' => $this->username])) {
            //echo "Пользователь найден \<br>";
            if ($this->password == $this->confirm) {
                $user = new UsersDB([
                    'login' => $this->username,
                    'name' => $this->name,
                    'password' => $this->password,
                    'email' => $this->email,
                ]);
                $user->save();
                //echo "Пользователь сохранен \<br>";
                //$event = new UserSucsavedEvent(['userId' => $user->id]);
                $this->trigger(static::EVENT_USER_SUCCESSFULLY_SAVED, $event);
            }
        } 
        $this->trigger(static::EVENT_USER_CREATE_COMPLETE);
        //echo "Метод завершен \<br>";
        
        if( $this->password == $user->password ) {
            $login = new LoginForm([ 'id' => $user->id, 'username' => $user->login, 'password' => $user->password]);
            $login->login();            
        
        } else $this->messageTOuser = 'This Login allredy taken or password not valid.</br>Please fill out the following fields to registrate:';
        
    }

    //русские имена для свойств
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'confirm' => 'ПарольX2',
            'name' => 'Имя',
            'email' => 'E-mail'
        ];
    }

    public function rules()
    {
        return [
            // all fields required
            [['username', 'password', 'confirm', 'name', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // подтверждение пароля
            ['confirm', 'compare', 'compareAttribute' => 'password'],
            
        ];
    }
    
}