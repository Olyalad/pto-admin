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
use lowbase\user\models\AuthItem;
use lowbase\user\models\AuthItemSearch;
use app\modules\user\models\GroupsSearch;

/**
 * Роли и допуски (административная часть)
 * Class AuthItemController
 * @package lowbase\user\controllers
 */
class AuthItemController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Менеджер ролей / допусков
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelGroup = new GroupsSearch();
        $dataProviderGroup = $searchModelGroup->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelGroup' => $searchModelGroup,
            'dataProviderGroup' => $dataProviderGroup,
        ]);
    }

    /**
     * Отображение роли / допуска
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создание роли / допуска
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $message = ($model->type == 1) ? Yii::t('user', 'Роль создана') : Yii::t('user', 'Допуск создан');
            Yii::$app->getSession()->setFlash('success', $message);
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Редактирование роли / допуска
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->fill(); // Заполнение дочерних ролей / допусков и пользователей, владеющих ими

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $message = ($model->type == 1) ? Yii::t('user', 'Роль отредактирована') : Yii::t('user', 'Допуск отредактирован');
            Yii::$app->getSession()->setFlash('success', $message);
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Удаление роли / допуска
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $message = ($model->type == 1) ? Yii::t('user', 'Роль удалена') : Yii::t('user', 'Допуск удален');
        $model->delete();
        Yii::$app->getSession()->setFlash('success', $message);

        return $this->redirect(['index']);
    }


    /**
     * Поиск модели (роль / допуск) по ID
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('user', 'Запрашиваемая страница не найдена.'));
        }
    }

}
