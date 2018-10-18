<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use app\models\Groups;
use app\models\User;
use yii\helpers\Html;
use kartik\grid\GridView;
use lowbase\user\UserAsset;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Пользователи');
$this->params['breadcrumbs'][] = $this->title;
UserAsset::register($this);
?>

<div class="user-index">

    <?php
    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '30px',
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
//            [
//                'attribute' => 'id',
//                'width' => '70px',
//            ],
        'login',
        'first_name',
//        'last_name',
//        'email:email',
        [
            'attribute' => 'groups',
            'filter' => Yii::$app->user->can('admin') ? Groups::getList() : null,
            'filterOptions' => Yii::$app->user->can('admin') ? [] : ['disabled' => true]
        ],

        [
            'attribute' => 'size',
        ],
        [
            'attribute' => 'cardsToday',
            'pageSummary'=>function ($summary, $data, $widget) { return 'Всего запросов: ' . $summary; },
        ],

        [
            'attribute' => 'status',
            'vAlign' => 'middle',
            'format' => 'raw',
            'value' => function ($model) {
                switch ($model->status) {
                    case User::STATUS_BLOCKED:
                        return '<span class="label label-danger">
                            <i class="glyphicon glyphicon-lock"></i> ' . User::getStatusArray()[User::STATUS_BLOCKED] . '</span>';
                        break;
                    case User::STATUS_WAIT:
                        return '<span class="label label-warning">
                            <i class="glyphicon glyphicon-hourglass"></i> ' . User::getStatusArray()[User::STATUS_WAIT] . '</span>';
                        break;
                    case User::STATUS_ACTIVE:
                        return '<span class="label label-success">
                            <i class="glyphicon glyphicon-ok"></i> ' . User::getStatusArray()[User::STATUS_ACTIVE] . '</span>';
                        break;
                }
                return false;
            },
            'filter' => User::getStatusArray(),
        ],
        [
            'template' => '{view} {update} {delete}',
            'class' => 'kartik\grid\ActionColumn',
            'visibleButtons' => [
                'update' => Yii::$app->user->can('admin'),
                'delete' => Yii::$app->user->can('admin'),
            ],
        ],
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
            'heading' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('user', 'Пользователи'),
            'type' => GridView::TYPE_PRIMARY,
            'before' => Html::a('Добавить пользователя', ['create'], [
                'class' => 'btn btn-success',
            ]),
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize' => false,
        'hover' => true,
        'responsive' => true,

        'showPageSummary' => true,

        'defaultPagination' => 'all',
    ]);
    ?>

</div>


