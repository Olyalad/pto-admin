<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Основной контроллер сайта
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * Разделение ролей
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


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

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Авторизация
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        // Уже авторизированных отправляем на домашнюю страницу
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $this->layout = 'main-login.php';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     * Деавторизация
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}

