<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\ProfileForm */


$this->title = Yii::t('user', 'Редактирование данных пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'Редактирование');
?>
<div class="user-update">

    <div class="box box-solid">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
                'disabled_group' => false,
            ]) ?>

        </div>
    </div>


</div>
