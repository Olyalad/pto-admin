<?php

namespace app\modules\register\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\register\models\Card;
use app\modules\register\models\AddCardForm;
use app\modules\register\models\CardSearch;
use Mpdf\Mpdf;

/**
 * CardController implements the CRUD actions for Card model.
 */
class CardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'print', 'print-stamp', 'create', 'fill'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Card models.
     * @return mixed
     */
    public function actionIndex()
    {
        $yesterday = Yii::$app->formatter->asDate(date('Y-m-d', strtotime('-1 days')), 'yyyy-MM-dd');
        $today = Yii::$app->formatter->asDate(time(), 'yyyy-MM-dd');
        $searchModel = new CardSearch([
            'dated' => "$yesterday - $today",
            'dated_start' => $yesterday,
            'dated_finish' => $today,
        ]);
        if (!Yii::$app->user->can('admin')) {
            $searchModel->user = Yii::$app->user->identity->login;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddCardForm();

        if ($message = $model->checkLimit() !== true) {
            Yii::$app->session->addFlash('error', $message);
            return $this->redirect(['index']);
        }

        $model->dated = Yii::$app->formatter->asDate(time(), 'yyyy-MM-dd');
        $model->dateof = Yii::$app->formatter->asDate(date('Y-m-d', strtotime('+1 years')), 'yyyy-MM-dd');
        $model->kat = 'B';

        if ($model->load(Yii::$app->request->post()) && $model->add()) {
            return $this->redirect(['view', 'id' => $model->card_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPrint($id)
    {
        $model = $this->findModel($id);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 6,
            'default_font' => '',
            'margin_left' => 8,
            'margin_right' => 8,
            'margin_top' => 12,
            'margin_bottom' => 12,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]); /*задаем формат, отступы и.т.д.*/
        $mpdf->charset_in = 'utf-8'; /*не забываем про русский*/


        $html = $this->renderPartial('print', [
            'model' => $model,
            'eisto_bordered' => $this->getBordered($model->eista),
            'dateof_bordered' => $this->getBordered(Yii::$app->formatter->asDate($model->dateof, 'dd.MM.yyyy'), false),
            'dated_bordered' => $this->getBordered(Yii::$app->formatter->asDate($model->dated, 'dd.MM.yyyy'), false),

        ]);

        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html); /*формируем pdf*/
        $mpdf->Output('card.pdf', 'I');

        exit;
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPrintStamp($id)
    {
        $model = $this->findModel($id);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'default_font_size' => 6,
            'default_font' => '',
            'margin_left' => 8,
            'margin_right' => 8,
            'margin_top' => 12,
            'margin_bottom' => 12,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]); /*задаем формат, отступы и.т.д.*/
        $mpdf->charset_in = 'utf-8'; /*не забываем про русский*/

        $html = $this->renderPartial('print-stamp', [
            'model' => $model,
            'eisto_bordered' => $this->getBordered($model->eista),
            'dateof_bordered' => $this->getBordered(Yii::$app->formatter->asDate($model->dateof, 'dd.MM.yyyy'), false),
            'dated_bordered' => $this->getBordered(Yii::$app->formatter->asDate($model->dated, 'dd.MM.yyyy'), false),

        ]);

        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html); /*формируем pdf*/
        $mpdf->Output('card.pdf', 'I');

        exit;
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFill($id)
    {
        $model = $this->findModel($id);

        Yii::$app->response->cookies->add(new Cookie([
            'name' => 'search-params',
            'value' => serialize([
                'vin' => $model->vin,
                'reg' => $model->reg,
            ]),
        ]));

        return $this->redirect(['/search']);

    }

    /**
     * Updates an existing Card model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Card model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    private function getBordered($string, $dot_delete = true)
    {
        $string_final = '';
        if ($dot_delete) {
            $charsArray = preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($charsArray as $v) {
                $v = '<td style="border: 1px solid #000; font-weight:bold; text-align:center; vertical-align: middle;">' . $v . '</td>';
                $string_final .= $v;
            }
        } else {
            $charsArray = explode(".", $string);
            $charsArrayWitoutDots = implode("", $charsArray);
            $charsArrayWitoutDots = preg_split('//', $charsArrayWitoutDots, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($charsArrayWitoutDots as $v) {
                $v = '<td style="border: 1px solid #000; width:15px; font-weight:bold; text-align:center; vertical-align: middle;">' . $v . '</td>';
                $string_final .= $v;
            }
        }

        return $string_final;
    }
}
