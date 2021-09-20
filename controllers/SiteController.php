<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Date;

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
        $model = new Date();

        // Если пришел ajax запрос
        if(Yii::$app->request->isAjax) {

          // Если пришел GET запрос
          // Возвращаем Json 
          if(Yii::$app->request->isGet) {
            // Находим все имеющиеся записи в таблице
            return json_encode($model::find()->asArray()->where('booked')->all());
          }

          // Принимаем переданые данные методом POST
          $model->booked = Yii::$app->request->post('data');
          // Сохраняем в модель
          // Записываем в БД
          $model->save();

        }

        return $this->render('index');
    }

}
