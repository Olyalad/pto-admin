<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use app\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\Groups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('user', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
                <?php
                if (!$model->isNewRecord) {
                    Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('user', 'Удалить'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('user', 'Вы уверены, что хотите удалить группу?'),
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>
                <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i> ' . Yii::t('user', 'Отмена'), ['index'], [
                    'class' => 'btn btn-default',
                ]) ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'nameg')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'sec')->dropDownList(User::getListUsers()) ?>
        </div>
    </div>


    <?= '<label class="control-label">' . Yii::t('user', 'Пользователи в группе') . '</label>' ?>
    <?= Select2::widget([
        'name' => 'Groups[user_array]',
        'value' => array_keys($model->user_array),
        'data' => User::getAll(),
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]);
    ?>


    <?php ActiveForm::end(); ?>

</div>
