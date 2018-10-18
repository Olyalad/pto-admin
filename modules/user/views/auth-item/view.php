<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use lowbase\user\UserAsset;

/* @var $this yii\web\View */
/* @var $model lowbase\user\models\AuthItem */

$this->title = Yii::t('user', 'Просмотр');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Права и группы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
UserAsset::register($this);
?>

<div class="auth-item-view">

    <div class="box box-solid">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> '.Yii::t('user', 'Редактировать'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i> '.Yii::t('user', 'Удалить'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('user', 'Вы уверены, что хотите удалить').' '.(($model->type === 1) ? Yii::t('user', 'роль') : Yii::t('user', 'допуск')).'?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i> '.Yii::t('user', 'Отмена'), ['index'], [
                    'class' => 'btn btn-default',
                ]) ?>
            </p>

            <?php
            $users = '';
            if ($model->users) {
                foreach ($model->users as $user) {
                    $name = ($user->last_name) ? $user->first_name ." ".$user->last_name." (".$user->login.")" : $user->first_name . " (".$user->login.")";
                    $users .= Html::a('<span class="label label-success">'.$name.'</span>', ['user/view', 'id' => $user->id])." ";
                }
            }
            ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description:ntext',
                    [
                        'attribute' => 'created_at',
                        'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                    ],
                    [
                        'attribute' => Yii::t('user', 'Пользователи имеют'),
                        'format' => 'raw',
                        'value' =>  ($users) ? $users : null,
                    ],
                ],
            ]) ?>

        </div>
    </div>



</div>
