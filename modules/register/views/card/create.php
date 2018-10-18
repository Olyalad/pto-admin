<?php

use app\assets\AdminLtePluginAsset;
use app\models\Canal;
use app\modules\register\models\Card;
use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\modules\register\models\AddCardForm */

$this->title = 'Новая карта';
$this->params['breadcrumbs'][] = ['label' => 'Реестр', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/css/card-form.css');
AdminLtePluginAsset::register($this);

$js = <<< JS
$('#addcardform-phone').inputmask('79999999999');
$('#addcardform-kogda').inputmask('99.99.9999');
$('#addcardform-dated').inputmask('99.99.9999');
$('#addcardform-dateof').inputmask('99.99.9999');
$('#addcardform-vin').inputmask('*****************');
JS;
$this->registerJs($js);

$formatter = Yii::$app->formatter;
?>

<div class="card-create">

    <div class="box box-solid">
        <div class="box-body">

            <div id="card_form">

                <?php $form = ActiveForm::begin([]); ?>

                <?= $form->field($model, 'card_id', ['template' => '{input}'])->hiddenInput() ?>

                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Лицо, представившее ТС для проведения ТО</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'surname')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'firstname')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'middlename')->textInput() ?>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'phone')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'ist')->dropDownList(Canal::getList()) ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Сведения о ТС</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3"><?= $form->field($model, 'vin')->textInput() ?></div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'yvip')->widget(DatePicker::className(), [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'format' => 'yyyy',
                                        'startView' => 2,
                                        'minViewMode' => 2,
                                        'maxViewMode' => 2,
                                        'endDate' => date('Y'),
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-3"><?= $form->field($model, 'mark')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'model')->textInput() ?></div>
                            <div class="clearfix"></div>
                            <div class="col-md-3"><?= $form->field($model, 'kuz')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'ram')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'probeg')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'reg')->textInput() ?></div>
                            <div class="clearfix"></div>
                            <div class="col-md-3"><?= $form->field($model, 'mass')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'rmass')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'kat')
                                    ->textInput(['readOnly' => 'readOnly']) ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'kat1')
                                    ->dropDownList(['M1' => 'M1', 'N1' => 'N1']) ?></div>
                            <div class="clearfix"></div>
                            <div class="col-md-3"><?= $form->field($model, 'shin')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'topl')
                                    ->dropDownList(Card::$toplNames) ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'torm')
                                    ->dropDownList(Card::$tormNames) ?></div>

                            <div class="clearfix"></div>
                            <hr>

                            <div class="col-md-3"><?= $form->field($model, 'doc')
                                    ->dropDownList(Card::$docNames) ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'sireal')->textInput() ?></div>
                            <div class="col-md-3"><?= $form->field($model, 'number')->textInput() ?></div>
                            <div class="col-md-3">
                                <?php
                                if ($model->kogda)
                                    $model->kogda = $formatter->asDate($model->kogda, 'dd.MM.yyyy');
                                echo $form->field($model, 'kogda')->widget(DatePicker::className(), [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'format' => 'dd.mm.yyyy',
                                        'endDate' => date('d.m.Y'),
                                    ],
                                ]) ?>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-3"><?= $form->field($model, 'inostr')->checkbox() ?></div>
                            <div class="col-md-9"><?= $form->field($model, 'kem')->textInput() ?></div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <?php
                        if ($model->dateof)
                            $model->dateof = $formatter->asDate($model->dateof, 'dd.MM.yyyy');
                        echo $form->field($model, 'dateof')->widget(DatePicker::className(), [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy'
                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                        if ($model->dated)
                            $model->dated = $formatter->asDate($model->dated, 'dd.MM.yyyy');
                        echo $form->field($model, 'dated')->widget(DatePicker::className(), [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy'
                            ],
                        ]) ?>
                    </div>

                    <?php if (Yii::$app->user->can('user_expert')) { ?>
                        <!--  поле только для user_expert-->
                        <div class="col-md-3 col-md-offset-3">
                            <?= $form->field($model, 'test')
                                ->dropDownList(Card::$testNames); ?>
                        </div>
                    <?php } ?>

                </div>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-sm pull-right']) ?>
                </div>


                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
