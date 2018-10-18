<?php

use yii\helpers\Html;

/** @var $model \app\modules\register\models\Card */
/** @var $eisto_bordered string */
/** @var $dateof_bordered string */
/** @var $dated_bordered string */
?>

<style type="text/css">

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
    }

    .container {
        overflow: hidden;
    }

    .box {
        white-space: nowrap
    }

    .box div {
        display: inline-block;
    }

    .number {
        text-align: center;
    }

    table {
        border-collapse: collapse !important;
    }

    td {
        border: 0.06em solid #000;
    }

    .noborder {
        border: none !important;
    }

    .little_text {
        font-size: 8px !important;
    }

    .main_text {
        font-size: 0.65em !important;
    }

    .main_text_big {
        font-size: 1.05em !important;
    }

    .vertical_format_text {
        font-size: 1.05em !important;
    }
</style>


<div></div>
<div style="width:100%; overflow:hidden; float:left; position: relative; z-index:50;">

    <table width="100%">
        <tr>
            <td class="noborder" align="center">
                <div style="font-size: 14px;"><b>Диагностическая карта<b></div>
                <div style="font-size: 14px;"><b>Certificate of periodic technical inspection</b></div>
                <table cellpadding="2" cellspacing="0" border="0" width="70%">
                    <tr>
                        <td class="noborder">
                            <div style="font-size: 10px;"><b>Регистрационный номер</b></div>
                        </td>
                        <td class="noborder"><?= $eisto_bordered ?></td>
                        <td class="noborder" style="font-size: 10px;"><b>срок действия</b></td>
                        <td class="noborder"><?= $dateof_bordered ?></td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td colspan="6" style="font-size:8px;"><b>Оператор технического осмотра: Общество с ограниченной
                    ответственностью "ПУНКТ ТЕХНИЧЕСКОГО ОСМОТРА 54" (ООО "ПТО 54") Адрес: Новосибирская обл, г. Бердск,
                    Первомайская 8 корпус 2.</b>
            </td>
        </tr>
        <tr>
            <td colspan="1" style="font-size:8px">Регистрационный знак ТС: <b><?= $model->reg ?></b></td>
            <td colspan="1" style="font-size:8px">Первичная проверка <b>|x|</b></td>
            <td colspan="4" style="font-size:8px"> Повторная проверка <b>| |</b></td>
        </tr>
        <tr>
            <td colspan="1" style="font-size:8px">VIN: <b><?= $model->vin ?: 'ОТСУТСТВУЕТ' ?></b></td>
            <td colspan="5" style="font-size:8px">Марка, модель ТС: <b><?= $model->mark ?></b></td>
        </tr>
        <tr>
            <td colspan="1" style="font-size:8px">Номер шасси, рамы: <b><?= $model->ram ?: 'ОТСУТСТВУЕТ' ?></b></td>
            <td colspan="5" style="font-size:8px">Категория ТС: <?= $model->kat ?> <b><?= $model->kat1 ?></b></td>
        </tr>
        <tr>
            <td colspan="1" style="font-size:8px">Номер кузова: <b><?= $model->kuz ?: 'ОТСУТСТВУЕТ' ?></b></td>
            <td colspan="5">Год выпуска ТС: <b><?= $model->yvip ?></b></td>
        </tr>
        <tr>
            <td colspan="6" style="font-size:8px"><b><?= $model->getDocName() ?></b>
                серия <b><?= $model->sireal ?></b> номер <b><?= $model->number ?></b> выдан:
                <b><?= Yii::$app->formatter->asDate($model->kogda, 'dd.MM.yyyy') ?> <?= htmlspecialchars($model->kem) ?></b>
            </td>
        </tr>
    </table>
    <br>
    <table cellpadding="0" cellspacing="0" width="100%" style="font-size: 8px;">
        <tr align="center" height="10">
            <td style="width: 30px; text-align:center; font-size: 8px; font-weight: bold;">№</td>
            <td class="main_text_big">Параметры и требования, предъявляемые к транспортным средствам при проведении
                технического осмотра
            </td>
            <td style="width: 10px; font-size: 8px; font-weight: bold;"></td>
            <td style="width: 30px; text-align:center; font-size: 8px; font-weight: bold;">№</td>
            <td class="main_text_big">Параметры и требования, предъявляемые к транспортным средствам при проведении
                технического осмотра
            </td>
            <td style="width: 10px; font-size: 8px; font-weight: bold;"></td>
            <td style="width: 30px; text-align:center; font-size: 8px; font-weight: bold;">№</td>
            <td class="main_text_big">Параметры и требования, предъявляемые к транспортным средствам при проведении
                технического осмотра
            </td>
            <td style="width: 10px; font-size: 12px;"></td>
        </tr>
        <tr align="center" height="10">
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold; height: 30px;">I. Тормозные
                системы
            </td>
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold;">IV. Стеклоочистители и
                стеклоомыватели
            </td>
            <td class="number" style="font-size: 8px; font-weight: bold;">46</td>
            <td class="main_text_big" align="left">Наличие работоспособного звукового сигнального
                прибора
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">1</td>
            <td class="main_text_big" align="left">Соответствие показателей эффективности торможения и устойчивости
                торможения
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">24</td>
            <td class="main_text_big" align="left">Наличие и работоспособность предусмотренных изгот.
                ТС в эксп. документации транспортного средства
                стелкоочистителей и стеклоомывателей
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">47</td>
            <td class="main_text_big" align="left">Наличие обозначений аварийных выходов и табличек по
                правилам их использования. Обеспечение свободного
                доступа к аварийным выходам
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td style="height: 30px; text-align:center; font-size: 8px; font-weight: bold;">2</td>
            <td class="main_text_big" align="left">Соответствие разности тормозных сил установленным
                требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">25</td>
            <td class="main_text_big" align="left">Обеспечение стеклоомывателем подачи жидкости в
                зоны очистки стекла
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">48</td>
            <td class="main_text_big" align="left">Наличие задних и боковых защитных устройств,
                соответствие их нормам
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">3</td>
            <td class="main_text_big" align="left">Работоспособность рабочей тормозной системы
                автопоездов с пневматическим тормозным приводом в
                режиме аварийного (автоматического) торможения
            </td>
            <td style="text-align:center;">-</td>
            <td class="number" style="font-size: 8px; font-weight: bold;">26</td>
            <td class="main_text_big" align="left">Работоспособность стеклоочистителей и
                стеклоомывателей
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">49</td>
            <td class="main_text_big" align="left">Раб-ть автоматического замка, ручной и автоматической
                блокировки седельно-сцепного устройства. Отсутствие
                видимых повреждений сцепных устройств
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">4</td>
            <td class="main_text_big" align="left">Отсутствие утечек сжатого воздуха из колесных
                тормозных камер
            </td>
            <td style="text-align:center;">-</td>
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold;">V. Шины и колеса</td>
            <td class="number" style="font-size: 8px; font-weight: bold;">50</td>
            <td class="main_text_big" align="left">Наличие раб-ных предохранительных приспособлений у
                одноосных прицепов (за исключением роспусков) и
                прицепов, не оборудованных раб. тормозной системой
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">5</td>
            <td class="main_text_big" align="left">Отсутствие подтеканий тормозной жидкости, нарушения
                герметичности трубопроводов или соединений в
                гидравлическом тормозном приводе
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">27</td>
            <td class="main_text_big" align="left">Соответствие высоты рисунка протектора шин
                установленным требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">51</td>
            <td class="main_text_big" align="left">Оборуд. прицепов (за искл. одноосных и роспусков)
                испр. уст., поддерж. сцепную петлю дышла в полож-ии,
                облегчающем сцепку и расцепку с тяговым автомобилем
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">6</td>
            <td class="main_text_big" align="left">Отсутствие коррозии, грозящей потерей герметичности
                или разрушением
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">28</td>
            <td class="main_text_big" align="left">Отсутствие признаков непригодности шин к эксплуатации</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">52</td>
            <td class="main_text_big" align="left">Отсутствие продольного люфта в беззазорных тягово-
                сцепных устройствах с тяговой вилкой для сцепленного с
                прицепом тягача
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">7</td>
            <td class="main_text_big" align="left">Отсутствие механических повреждений тормозных
                трубопроводов
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">29</td>
            <td class="main_text_big" align="left">Наличие всех болтов или гаек крепления дисков и
                ободьев колес
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">53</td>
            <td class="main_text_big" align="left">Обеспечение тягово-сцепными устройствами легковых
                автомобилей беззазорной сцепки сухарей замкового
                устройства с шаром
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">8</td>
            <td class="main_text_big" align="left">Отсутствие трещин остаточной деформации деталей тормозного привода
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">30</td>
            <td class="main_text_big" align="left">Отсутствие трещин на дисках и ободьях колес</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">54</td>
            <td class="main_text_big" align="left">Соответствие размерных характеристик сцепных
                устройств установленным требованиям
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">9</td>
            <td class="main_text_big" align="left">Исправность средств сигнализации и контроля тормозных систем</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">31</td>
            <td class="main_text_big" align="left">Отсутствие видимых нарушений формы и размеров
                крепежных отверстий в дисках колес
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">55</td>
            <td class="main_text_big" align="left">Оснащение транспортных средств исправными ремнями
                безопасности
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">10</td>
            <td class="main_text_big" align="left">Отсутствие набухания тормозных шлангов под давлением, трещин и
                видимых мест перетирания
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">32</td>
            <td class="main_text_big" align="left">Установка шин на транспортное средство в соответствии
                с требованиями
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">56</td>
            <td class="main_text_big" align="left">Наличие знака аварийной остановки и медицинской
                аптечки
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">11</td>
            <td class="main_text_big" align="left">Расположение и длина соединительных шлангов пневматического
                тормозного привода автопоездов
            </td>
            <td style="text-align:center;">-</td>
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold;">VI. Двигатель и его системы
            </td>
            <td class="number" style="font-size: 8px; font-weight: bold;">57</td>
            <td class="main_text_big" align="left">Наличие не менее двух противооткатных упоров</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center">
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold; height: 30px;">II. Рулевое
                управление
            </td>
            <td class="number" style="font-size: 8px; font-weight: bold;">33</td>
            <td class="main_text_big" align="left">Соответствие содержания загрязняющих веществ в
                отработавших газах транспортных средств
                установленным требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">58</td>
            <td class="main_text_big" align="left">Наличие огнетушителей, соответствующих
                установленным требованиям
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">12</td>
            <td class="main_text_big" align="left">Работоспособность усилителя рулевого управления. Плавность изменения
                усилия при повороте рулевого колеса
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">34</td>
            <td class="main_text_big" align="left">Отсутствие подтекания и каплепадения топлива в
                системе питания
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">59</td>
            <td class="main_text_big" align="left">Надежное крепление поручней в автобусах, запасного
                колеса, аккумуляторной батареи, сидений,
                огнетушителей и медицинской аптечки
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">13</td>
            <td class="main_text_big" align="left">Отсутствие самопроизвольного поворота рулевого колеса с усилителем
                рулевого управления от нейтрального положения при работающем двигателе
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">35</td>
            <td class="main_text_big" align="left">Работоспособность запорных устройств и устройств
                перекрытия топлива
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">60</td>
            <td class="main_text_big" align="left">Работоспособность механизмов регулировки сидений</td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">14</td>
            <td class="main_text_big" align="left">Отсутствие превышения предельных значений суммарного люфта в рулевом
                управлении
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">36</td>
            <td class="main_text_big" align="left">Соответсвие системы питания газобаллнонных ТС, ее
                размещение и установки установленным требованиям
            </td>
            <td style="text-align:center;">-</td>
            <td class="number" style="font-size: 8px; font-weight: bold;">61</td>
            <td class="main_text_big" align="left">Наличие надколесных грязезащитных устройств,
                отвечающих установленным требованиям
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">15</td>
            <td class="main_text_big" align="left">Отсутствие повреждения и полная комплектность деталей крепления
                рулевой колонки и картера рулевого механизма
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">37</td>
            <td class="main_text_big" align="left">Соответствие нормам уровня шума выпускной системы</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">62</td>
            <td class="main_text_big" align="left">Соответствие вертикальной статической нагрузки на
                тяговое устройство автомобиля от сцепной петли
                одноосного прицепа (прицепа-роспуска) нормам
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">16</td>
            <td class="main_text_big" align="left">Отсутствие следов остаточной деформации, трещин и других дефектов в
                рулевом механизме и рулевом приводе
            </td>
            <td></td>
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold;">VII. Прочие элементы
                конструкции
            </td>
            <td class="number" style="font-size: 8px; font-weight: bold;">63</td>
            <td class="main_text_big" align="left">Работоспособность держателя запасного колеса,
                лебедки и механизма подъема-опускания запасного
                колеса
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">17</td>
            <td class="main_text_big" align="left">Отсутствие устройств, ограничивающих поворот рулевого
                колеса, не предусмотренных конструкцией
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">38</td>
            <td class="main_text_big" align="left">Наличие зеркал заднего вида в соответствии с
                требованиями
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">64</td>
            <td class="main_text_big" align="left">Работоспособность механизмов подъема и опускания
                опор и фиксаторов транспортного положения опор
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" style="height: 80px;">
            <td colspan="3" style="font-size: 12px; text-align:center; font-weight: bold;">III. Внешние
                световыеприборы
            </td>
            <td class="number" style="font-size: 8px; font-weight: bold;">39</td>
            <td class="main_text_big" align="left">Отс. доп. предметов или покрытий, огранич. обзорность
                с места водителя. Соответствие полосы пленки в верхней
                части ветрового стекла уст. требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">65</td>
            <td class="main_text_big" align="left">Отсутствие каплепадения масел и рабочих жидкостей</td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">18</td>
            <td class="main_text_big" align="left">Соответствие устройств освещения и световой сигнализации
                установленным требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">40</td>
            <td class="main_text_big" align="left">Соответствие норме светопропускания ветрового стекла,
                передних боковых стекол и стекол передних дверей
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">66</td>
            <td class="main_text_big" align="left">Установка государственных регистрационных знаков в
                соответствии с требованиями
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">19</td>
            <td class="main_text_big" align="left">Отсутствие разрушений рассеивателей световых приборов</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">41</td>
            <td class="main_text_big" align="left">Отсутствие трещин на ветровом стекле в зоне очистки
                водительского стеклоочистителя
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">67</td>
            <td class="main_text_big" align="left">Работоспособность устройства или системы вызова
                экстренных оперативных служб
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">20</td>
            <td class="main_text_big" align="left">Работоспособность и режим работы сигналов торможения</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">42</td>
            <td class="main_text_big" align="left">Раб-ть замков дверей кузова, кабины, мех. регулировки и фиксирующих
                устройств сидений, устр. обогрева и обдува ветрового стекла, противоугонного устройства
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">68</td>
            <td class="main_text_big" align="left">Отсутствие изменений в конструкции ТС, внесенных в
                нарушение уствновленных требований
            </td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">21</td>
            <td class="main_text_big" align="left">Соответствие углов регулировки и силы света фар установленным
                требованиям
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">43</td>
            <td class="main_text_big" align="left">Работоспособность запоров бортов грузовой платформы
                и запоров горловин цистерн
            </td>
            <td style="text-align:center;">-</td>
            <td class="number" style="font-size: 8px; font-weight: bold;">69</td>
            <td class="main_text_big" align="left">Соответствие ТС установленным дополнительным
                требованиям
            </td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">22</td>
            <td class="main_text_big" align="left">Наличие и расположение фар и сигнальных фонарей в местах,
                предусмотренных конструкцией
            </td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">44</td>
            <td class="main_text_big" align="left">Работоспособность аварийного выключателя дверей и
                сигнала требования остановки
            </td>
            <td style="text-align:center;">-</td>
            <td></td>
            <td class="main_text_big" align="left"></td>
            <td></td>
        </tr>
        <tr align="center" height="10">
            <td class="number" style="font-size: 8px; font-weight: bold;">23</td>
            <td class="main_text_big" align="left">Соответствие источника света в фарах</td>
            <td></td>
            <td class="number" style="font-size: 8px; font-weight: bold;">45</td>
            <td class="main_text_big" align="left">Работоспособность аварийных выходов, приборов внутреннего освещения
                салона, привода управления дверями и сигнализации их работы
            </td>
            <td style="text-align:center;">-</td>
            <td></td>
            <td class="main_text_big" align="left"></td>
            <td></td>
        </tr>
    </table>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="width:100%; float:right; position: relative; z-index: 50">
    <div style="font-size: 14px; text-align:center; font-weight: bold;">Результаты диагностирования</div>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr>
            <td colspan="4" align="left"><b>Параметры, по которым установлено несоответствие</b></td>
            <td rowspan="2" align="center">Пункт ДК</td>
        </tr>
        <tr>
            <td width="180">Нижняя граница</td>
            <td width="180">Рез. проверки</td>
            <td width="180">Верхняя граница</td>
            <td>Наименование параметра</td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height: 15px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" align="left"><b>Невыполненые требования</b></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" align="center">Предмет проверки<br>(узел, деталь, агрегат)</td>
            <td colspan="2" align="center">Содержание невыполненного требования<br>(с указанием нормативного источника)
            </td>
            <td align="center">Пункт ДК</td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 15px"></td>
            <td colspan="2"></td>
            <td></td>
        </tr>
    </table>

    <b>Особые отметки:</b>
    <br>
    <br>
    <br>
    <br>
    <b>Примечания: VIN: <?= $model->vin ?: 'ОТСУТСТВУЕТ' ?></b>
    <hr>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr>
            <td colspan="2" align="center"><b>Данные транспортного средства:</b></td>
        </tr>
        <tr>
            <td width="50%">Масса без нагрузки: <?= $model->mass ?></td>
            <td>Разрешенная максимальная масса: <?= $model->rmass ?></td>
        </tr>
        <tr>
            <td>Тип топлива: <?= $model->getToplName() ?></td>
            <td>Пробег: <?= $model->probeg ?></td>
        </tr>
        <tr>
            <td>Тип тормозной системы: <?= $model->getTormName() ?></td>
            <td rowspan="2"><b>Номер ДК ЕАИСТО ГИБДД: <?= $model->eista ?></b></td>
        </tr>
        <tr>
            <td>Марка шин: <?= $model->shin ?></td>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr>

            <td class="vertical_format_text" width="50%">Заключение о возможности/невозможности<br> эксплуатации
                транспортного средства <br>Results of the roadworthiness inspection
            </td>
            <td align="center">
                <table align="center" bordr="0" width="400">
                    <tr>
                        <td class="noborder">
                            <?php
                            if ($model->test == 'N') {
                                $img = 'nopassed.gif';
                                $img1 = 'failed.gif';
                            } else {
                                $img = 'passed.gif';
                                $img1 = 'nofiled.gif';
                            }
                            echo Html::img('./img/' . $img, ['width' => '105', 'height' => '34']);
                            echo '&nbsp;&nbsp;';
                            echo Html::img('./img/' . $img1, ['width' => '105', 'height' => '34']);
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr height="70" valign="top">
            <td class="vertical_format_text" width="70%" style="height: 35px; vertical-align: top;"><b>Пункты
                    диагностической карты, требующие повторной проверки:</b></td>
            <td></td>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr height="90" valign="top">
            <td>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td class="noborder vertical_format_text" width="50%"><b>Технический эксперт: Андриянов Андрей
                                Анатольевич</b><br><br></td>
                        <td class="noborder">Дата выдачи:</td>
                        <?= $dated_bordered ?>
                    </tr>
                    <tr>
                        <td class="noborder">Подпись _______________________________<br>Signature</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

