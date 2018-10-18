<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

namespace app\modules\user\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\User;
use app\models\UserSearch;
use app\modules\user\models\ProfileForm;

/**
 * Пользователи (административная часть)
 * Class UserController
 * @package app\modules\back_user\controllers
 */
class UserController extends Controller
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
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create'],
                        'allow' => true,
                        'roles' => ['admin', 'group_expert'],
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }


    /**
     * Менеджер пользователей (список таблицей)
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр пользователя (карточки)
     * @param $id - ID пользователя
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // можно смотреть только свою группу
        $thisUser = Yii::$app->user;
        if ($thisUser->can('group_expert') && !$thisUser->can('admin')
            && $model->groups != $thisUser->identity->groups) {
            throw new NotFoundHttpException(Yii::t('user', 'Запрашиваемая страница не найдена.'));
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate()
    {
        $model = new ProfileForm();
        $model->scenario = ProfileForm::SCENARIO_CREATE;

        $disabled_group = false;
        $thisUser = Yii::$app->user;
        if ($thisUser->can('group_expert') && !$thisUser->can('admin')) {
            $model->groups = $thisUser->identity->groups;
            $disabled_group = true;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Пользователь создан.'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'disabled_group' => $disabled_group,
        ]);
    }

    /**
     * Редактирование пользователя в режиме
     * администрирования (по аналогии с личным кабинетом)
     * @param $id - ID пользователя
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = ProfileForm::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('user', 'Запрошенная страница не найдена.'));
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Данные профиля обновлены.'));
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Удаление пользователя
     * @param $id - ID пользователя
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Пользователь удален.'));

        return $this->redirect(['index']);
    }

    /**
     * Поиск пользователя по ID
     * @param $id - ID пользователя
     * @return User
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('user', 'Пользователь не найден.'));
        }
    }
}
