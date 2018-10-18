<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use lowbase\user\UserAsset;

/* @var $this yii\web\View */
/* @var $searchModel lowbase\user\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelGroup \app\modules\user\models\GroupsSearch */
/* @var $dataProviderGroup yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Права и группы');
$this->params['breadcrumbs'][] = $this->title;
$assets = UserAsset::register($this);

?>
<div class="auth-item-index">

    <?= GridView::widget([
        'layout' => "{items}\n{summary}\n{pager}",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '30px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            'name',

            'description:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'template' => '{view} {update} {delete}',
                'class' => 'kartik\grid\ActionColumn',
            ],
        ],
        'containerOptions' => ['style' => 'overflow: auto'],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => false,
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-eye-close"></i> ' . Yii::t('user', 'Права'),
            'type' => GridView::TYPE_PRIMARY,
            'before' => Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('user', 'Добавить'), [
                'auth-item/create'], ['class' => 'btn btn-success']),
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize' => false,
        'hover' => true,
        'responsive' => true,
    ]); ?>

    <?= GridView::widget([
        'layout' => "{items}\n{summary}\n{pager}",
        'dataProvider' => $dataProviderGroup,
        'filterModel' => $searchModelGroup,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '30px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            'nameg',
            'sec',

            [
                'template' => '{view} {update} {delete}',
                'class' => 'kartik\grid\ActionColumn',
                'urlCreator' => function ($action, $model) {

                    return Url::to(['/user/group/' . $action, 'id' => $model->id]);

                }
            ],
        ],
        'containerOptions' => ['style' => 'overflow: auto'],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => false,
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-eye-close"></i> ' . Yii::t('user', 'Группы'),
            'type' => GridView::TYPE_PRIMARY,
            'before' => Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('user', 'Добавить'), [
                'group/create'], ['class' => 'btn btn-success']),
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize' => false,
        'hover' => true,
        'responsive' => true,
    ]); ?>

</div>


