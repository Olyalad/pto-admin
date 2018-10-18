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
use app\models\Groups;

/**
 * Class AuthItemController
 * @package lowbase\user\controllers
 */
class GroupController extends Controller
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
        return $this->redirect('/user/auth-item/index');
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
     * Создание
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Groups();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $message = Yii::t('user', 'Группа создана');
            Yii::$app->getSession()->setFlash('success', $message);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Редактирование
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->fill(); // Заполнение пользователей в группе

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $message = Yii::t('user', 'Группа отредактирована');
            Yii::$app->getSession()->setFlash('success', $message);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Удаление
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', 'Группа удалена');
        return $this->redirect(['index']);
    }

    /**
     * @param string $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('user', 'Запрашиваемая страница не найдена.'));
        }
    }

}
