<?php

use app\models\Canal;
use app\modules\register\models\Card;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\register\models\Card */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Реестр', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-update">

    <div class="box box-solid">
        <div class="box-body">

            <div class="card-form">

                <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                ]); ?>

                <?= $form->field($model, 'fio')->textInput() ?>
                <?= $form->field($model, 'phone')->textInput() ?>
                <?= $form->field($model, 'vin')->textInput() ?>
                <?= $form->field($model, 'yvip')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'mark')->textInput() ?>
                <?= $form->field($model, 'kuz')->textInput() ?>
                <?= $form->field($model, 'ram')->textInput() ?>
                <?= $form->field($model, 'probeg')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'dated')->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ],
                ]) ?>
                <?= $form->field($model, 'reg')->textInput() ?>
                <?= $form->field($model, 'mass')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'rmass')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'shin')->textInput() ?>


                <?= $form->field($model, 'doc')->dropDownList(Card::$docNames) ?>
                <?= $form->field($model, 'sireal')->textInput() ?>
                <?= $form->field($model, 'number')->textInput() ?>
                <?= $form->field($model, 'kogda')->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ],
                ]) ?>
                <?= $form->field($model, 'kem')->textInput() ?>

                <?= $form->field($model, 'ist')->dropDownList(Canal::getList()) ?>
                <?= $form->field($model, 'topl')->dropDownList(Card::$toplNames) ?>
                <?= $form->field($model, 'torm')->dropDownList(Card::$tormNames) ?>

                <?= $form->field($model, 'kat')->textInput() ?>
                <?= $form->field($model, 'kat1')->textInput() ?>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>


                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>
