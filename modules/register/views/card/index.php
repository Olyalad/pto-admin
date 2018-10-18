<?php

use app\models\Canal;
use app\models\User;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\register\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Реестр');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

    <?php
    $gridColumns = [

        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{print} {print-stamp} {fill}',
            'header' => 'Печать',
            'buttons' => [
                'print' => function ($url, $model) {
                    return Html::a('Печать', $url, ['class' => 'btn btn-primary btn-xs']);
                },
                'print-stamp' => function ($url, $model) {
                    return Html::a('Печать со <br>штампом', $url, ['class' => 'btn btn-primary btn-xs']);
                },
                'fill' => function ($url, $model) {
                    return Html::a('Заполнить', $url, ['class' => 'btn btn-primary btn-xs']);
                },
            ],
        ],

        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'header' => false,
            'visibleButtons' => [
                'update' => Yii::$app->user->can('admin'),
                'delete' => Yii::$app->user->can('admin'),
            ],

        ],

        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '30px',
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        'eista',

        [
            'attribute' => 'user',
            'filter' => Yii::$app->user->can('admin') ? User::getListUsers() : null,
        ],

        [
            'attribute' => 'dated',
            'options' => ['class' => 'gridview-date-column'],
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'dated',
                'startAttribute' => 'dated_start',
                'endAttribute' => 'dated_finish',
                'convertFormat' => true,
                'pluginOptions' => [
                    'locale' => ['format' => 'Y-m-d'],
                ],
                'options' => ['class' => 'form-control', 'id' => null, 'style' => 'padding: 6px;'],
            ]),
            'contentOptions' => ['style' => 'min-width: 182px;'],
            'filterOptions' =>  ['style' => 'min-width: 182px;'],
            'headerOptions' =>  ['style' => 'min-width: 182px;'],
        ],


        'fio',
        [
            'attribute' => 'ist',
            'filter' => Canal::getList(),
        ],
        'mark',

        [
            'attribute' => 'dateof',
            'options' => ['class' => 'gridview-date-column'],
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'dateof',
                'startAttribute' => 'dateof_start',
                'endAttribute' => 'dateof_finish',
                'convertFormat' => true,
                'pluginOptions' => [
                    'locale' => ['format' => 'Y-m-d'],
                ],
            ]),
            'contentOptions' => ['style' => 'min-width: 200px;']
        ],

        's',
        'phone',


    ];

    echo GridView::widget([
        'layout' => "{items}\n{summary}\n{pager}",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => false,
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-list-alt"></i> Диагностические карты',
            'type' => GridView::TYPE_PRIMARY,

            'before' => Html::a('Добавить карту', ['create'], [
                'class' => 'filter btn btn-success',
            ]) . "    {toggleData} {export}",
        ],
        'toolbar' => false,

        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize' => true,
        'hover' => true,
        'responsive' => true,
    ]);
    ?>

</div>
