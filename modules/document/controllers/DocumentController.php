<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

namespace app\modules\document\controllers;

use Yii;
use yii\web\Controller;
use Mpdf\Mpdf;
use app\modules\document\models\Kvit;

/**
 * Документы (административная часть)
 * Class DocumentController
 * @package app\modules\back_document\controllers
 */
class DocumentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReceipt()
    {
        $kvit = new Kvit(['userk' => Yii::$app->user->identity->login]);
        $kvit->save();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 12,
            'default_font' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 7,
            'margin_bottom' => 7,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P',
        ]); /*задаем формат, отступы и.т.д.*/
        $mpdf->charset_in = 'utf-8'; /*не забываем про русский*/

        $content = $this->renderPartial('receipt', [
            'kvitId' => $kvit->id,
        ]);

        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($content); /*формируем pdf*/
        $mpdf->Output('card.pdf', 'I');

    }
}
