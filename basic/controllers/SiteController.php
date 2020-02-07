<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\RegForm;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\Event;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'cache_about' => [
                'class' => \yii\filters\PageCache::class,
                'duration' => 15,
                'only' => ['about']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Регистрация нового пользователя
     */
    public function actionRegistrate()
    {
        //

        $model = new RegForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->createUser()) {
            return $this->goHome();
        } 

        //$model->password = '';
        return $this->render('registrate', [
            'model' => $model,
        ]);
        
        /*
        $handler = function(Event $event) {echo'Пользователь подписан на рассылку!';};
        $model->on(RegForm::EVENT_USER_SUCCESSFULLY_SAVED, $handler); 
        //1:28
            
        $model->createUser();
        
        return $this->render('registrate', ['model' => $model,]);
        */
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $patter = ['Шла Маша по шоссе и сосала сушку.', 'Карл у Клары украл кораллы.', 'Из-под топота копыт пыль по полю летит.', 'Выборка по уборщицам на роллс-ройсах нерепрезентативна.', 'У Сени и Сани в сенях сом с усами.'];
        $model[title] = 'Коротко';
        $model[content] = $patter[array_rand($patter,1)];
        return $this->render('about', ['model' => $model]);
    }
    
    /**
     * Displays hello world page.
     *
     * @return string
    public function actionTasks()
    {
        return $this->render('tasks');
    }
     */

    
}
