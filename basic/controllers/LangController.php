<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use yii\web\UploadedFile;
//use app\models\Upload;

class LangController extends Controller
{
    public function actionRu() {
        $session = Yii::$app->session;
        //Yii::$app->language = 'ru';
        //$session->remove('language');
                
        $session->set('language', 'ru');
        
        $this->goHome();
        //echo Yii::$app->session->get(language);
    }  
    public function actionEn() {
        $session = Yii::$app->session;
        
        //Yii::$app->language = 'en-US';
                
        $session->set('language', 'en');
        
        $this->goHome();
    }    
}