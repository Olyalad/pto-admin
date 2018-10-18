<?php

/** @var $kvitId int */
?>

<style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
    }

    .container{
        overflow:hidden;
    }
    .box{
        white-space:nowrap
    }
    .box div{
        display:inline-block;
    }
    .i {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
    }
</style>



<table width="100%">
    <tr><td height="24">ООО "ТКТ"</td><td align="right"></td></tr>
    <tr><td style="font-weight: Normal;">ИНН 5445021967</td><td align="right"></td></tr>
    <tr><td style="font-weight: Normal;">ОГРН 116547610199</td><td align="right"></td></tr>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td>Квитанция №<?= $kvitId ?></td><td align="right">
            <?= Yii::$app->formatter->asDate(time(), '«d» MMMM yyyyг.') ?>
        </td></tr>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td colspan="2">
            <table align="center" cellspacing="0" cellpadding="2" border="1" width="100%">
                <tr>
                    <td height="40" rowspan="2" width="400">Наименование</td>
                    <td rowspan="2" align="center" width="60">Кол-во</td>
                    <td colspan="2" align="center">Стоимость</td>
                    <td colspan="2" align="center">Сумма</td>
                </tr>
                <tr>
                    <td align="center">Руб.</td>
                    <td align="center">Коп.</td>
                    <td align="center">Руб.</td>
                    <td align="center">Коп.</td>
                </tr>
                <tr>
                    <td height="40">Услуги оформления</td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td colspan="3" align="right">ИТОГО <br>(прописью)</td>
                    <td colspan="2"></td>
                </tr>
            </table>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td>Подпись продавца ______________</td><td align="right">________________ / __________________________________________________</td></tr>
    <tr><td height="28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(М.П.)</td><td align="right"></td></tr>

    <tr><td height="100" colspan="2"><hr width="100%" style="border-bottom: 1px dashed Silver;"></td></tr>

    <tr><td height="24">ООО "ТКТ"</td><td align="right"></td></tr>
    <tr><td style="font-weight: Normal;">ИНН 5445021967</td><td align="right"></td></tr>
    <tr><td style="font-weight: Normal;">ОГРН 116547610199</td><td align="right"></td></tr>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td>Квитанция №'.$iid.'</td><td align="right">'.(date('«d» ') . $monthes[(date('n'))] . date(' Y')).'г.</td></tr>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td colspan="2">
            <table align="center" cellspacing="0" cellpadding="2" border="1" width="100%">
                <tr>
                    <td height="40" rowspan="2" width="400">Наименование</td>
                    <td rowspan="2" align="center" width="60">Кол-во</td>
                    <td colspan="2" align="center">Стоимость</td>
                    <td colspan="2" align="center">Сумма</td>
                </tr>
                <tr>
                    <td align="center">Руб.</td>
                    <td align="center">Коп.</td>
                    <td align="center">Руб.</td>
                    <td align="center">Коп.</td>
                </tr>
                <tr>
                    <td height="40">Услуги оформления</td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td height="40"></td>
                    <td colspan="3" align="right">ИТОГО <br>(прописью)</td>
                    <td colspan="2"></td>
                </tr>
            </table>
    <tr><td height="28"></td><td align="right"></td></tr>
    <tr><td>Подпись продавца ______________</td><td align="right">________________ / __________________________________________________</td></tr>
    <tr><td height="28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(М.П.)</td><td align="right"></td></tr>
</table>