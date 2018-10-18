<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\Groups */

$this->title = Yii::t('user', 'Просмотр');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Права и группы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="auth-item-view">

    <div class="box box-solid">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('user', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('user', 'Удалить'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('user', 'Вы уверены, что хотите удалить группу?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i> ' . Yii::t('user', 'Отмена'), ['index'], [
                    'class' => 'btn btn-default',
                ]) ?>
            </p>

            <?php
            $users = '';
            if ($model->users) {
                foreach ($model->users as $user) {
                    $name = ($user->last_name) ? $user->first_name . " " . $user->last_name . " (" . $user->login . ")" : $user->first_name . " (" . $user->login . ")";
                    $users .= Html::a('<span class="label label-success">' . $name . '</span>', ['user/view', 'id' => $user->id]) . " ";
                }
            }
            ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nameg',
                    [
                        'attribute' => 'sec',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $user = $model->secUser;
                            $name = ($user->last_name) ? $user->first_name . " " . $user->last_name . " (" . $user->login . ")" : $user->first_name . " (" . $user->login . ")";
                            return Html::a('<span class="label label-primary">' . $name . '</span>', ['user/view', 'id' => $user->id]);
                        }
                    ],

                    [
                        'attribute' => Yii::t('user', 'Пользователи'),
                        'format' => 'raw',
                        'value' => ($users) ? $users : null,
                    ],
                ],
            ]) ?>

        </div>
    </div>


</div>
