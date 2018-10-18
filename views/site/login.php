<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

/* @var $this yii\web\View */
/* @var $model \app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use lowbase\user\UserAsset;

$this->title = 'Вход в админ панель';
$this->params['breadcrumbs'][] = $this->title;
UserAsset::register($this);
?>

<div class="site-login row" id="filter">

    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <p style="margin: 50px 0 30px 0; font-weight: bold; font-size: 20px"><img src="/img/log.png">ПТО54</p>


        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{input}\n{hint}\n{error}"
            ],
        ]); ?>

        <?= $form->field($model, 'login')->textInput([
            'maxlength' => true,
            'placeholder' => $model->getAttributeLabel('login')
        ]); ?>

        <?= $form->field($model, 'password')->passwordInput([
            'maxlength' => true,
            'placeholder' => $model->getAttributeLabel('password')
        ]);?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-log-in"></i> Войти в админ панель', [
                'class' => 'btn btn-lg btn-primary',
                'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-3">
    </div>
</div>
