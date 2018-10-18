<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use lowbase\user\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\User */

$this->title = Yii::t('user', 'Просмотр пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="box box-solid">
        <div class="box-body">
            <p>
                <?php if (Yii::$app->user->can('admin')) : ?>
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('user', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('user', 'Удалить'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('user', 'Вы уверены, что хотите удалить пользователя?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>

                <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i> ' . Yii::t('user', 'Отмена'), ['index'], [
                    'class' => 'btn btn-default',
                ]) ?>
            </p>

            <?php
            $roles = '';
            if ($model->authAssignments) {
                foreach ($model->authAssignments as $role) {
                    $type = ($role->itemName->type == 1) ? 'label-primary' : 'label-success';
                    $roles .= Html::a('<span class="label ' . $type . '">' . $role->itemName->description . '</span>', ['auth-item/view', 'id' => $role->itemName->name]) . " ";
                }
            }
            $groups = '';
            if ($group = $model->group) {
                $groups = Html::a('<span class="label label-success">' . $group->nameg . '</span>', ['group/view', 'id' => $group->id]);
            }
            ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'login',
                    'first_name',
                    'last_name',
                    'email:email',
                    [
                        'attribute' => 'sex',
                        'value' => ($model->sex) ? User::getSexArray()[$model->sex] : null,
                    ],
                    'birthday',
                    'phone',
                    [
                        'attribute' => 'status',
                        'value' => User::getStatusArray()[$model->status],
                    ],
                    'ip',
                    'size',
                    [
                        'attribute' => 'groups',
                        'format' => 'raw',
                        'value' => ($groups) ? $groups : null,
                    ],
                    's',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                    ],
                    [
                        'attribute' => 'login_at',
                        'format' => ['date', 'dd.MM.Y HH:mm:ss'],
                    ],
                    [
                        'attribute' => Yii::t('user', 'Обладает ролями и допусками'),
                        'format' => 'raw',
                        'value' => ($roles) ? $roles : null,
                    ],
                ],
            ]) ?>
        </div>
    </div>


</div>
