<?php

namespace app\modules\search\controllers;

use app\modules\search\models\SearchForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `search` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new SearchForm();

        $params = Yii::$app->request->cookies->get('search-params');

        if ($params) {
            $params = unserialize($params);
            Yii::$app->response->cookies->offsetUnset('search-params');

            $model->vin = $params['vin'];
            $model->reg = $params['reg'];
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->search()) {
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $model->getResult(),
                ]);
            }
        }

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => isset($dataProvider) ? $dataProvider : null,
        ]);
    }
}
