<?php

use app\models\Groups;
use app\models\User;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\ProfileForm */
/* @var $disabled_group bool */

?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form-create',
        'options' => [
            'class' => 'form',
        ],
    ]); ?>

    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('user', 'Сохранить'), ['class' => 'btn btn-primary']) ?>

                <?= !$model->isNewRecord ? Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('user', 'Удалить'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('user', 'Вы уверены, что хотите удалить пользователя?'),
                        'method' => 'post',
                    ],
                ]) : '' ?>
                <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i> ' . Yii::t('user', 'Отмена'), ['index'], [
                    'class' => 'btn btn-default',
                ]) ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'groups')->dropDownList(Groups::getList(), [
                'prompt' => '',
                'disabled' => $disabled_group,
            ]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'birthday')
                ->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => $model->getAttributeLabel('birthday')],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'sex')
                ->radioList([null => Yii::t('user', 'Не указан')] + User::getSexArray()) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList(User::getStatusArray()) ?>
        </div>
    </div>

    <?php if (!Yii::$app->user->can('zam')) : ?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 's')->textInput(['type' => 'number']) ?>
            </div>
        </div>

    <?php endif; ?>


    <?php ActiveForm::end(); ?>

</div>