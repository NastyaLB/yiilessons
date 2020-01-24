<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "usersDB".
 *
 * @property int $id
 * @property string $login
 * @property string $name
 * @property string $password
 * @property string creator_id
 */
class UsersDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usersDB';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'name', 'password'], 'required'],
            [['login', 'name', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'name' => 'Name',
            'password' => 'Password',
        ];
    }
    
    
    public function fields(){
        return [
            'id',
            'username' => 'login',
            'password'
        ];
    }
}
