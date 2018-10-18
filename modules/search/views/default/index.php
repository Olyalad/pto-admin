<?php

use app\assets\AdminLtePluginAsset;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \app\modules\search\models\SearchForm */
/** @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;

AdminLtePluginAsset::register($this);

$js = <<< JS
$('#searchform-vin').inputmask('*****************');
JS;
$this->registerJs($js);

$this->registerCss("
#search_form .form-control {
    text-transform: uppercase;
}
");
?>

    <div class="box box-solid">
        <div class="box-body">
            <?php $form = ActiveForm::begin([
                'id' => 'search_form',
                'layout' => 'inline',
                'enableClientValidation' => false,
            ]); ?>

            <?= $form->field($model, 'vin')->textInput(['placeholder' => $model->getAttributeLabel('vin')]) ?>
            <?= $form->field($model, 'reg')->textInput(['placeholder' => $model->getAttributeLabel('reg')]) ?>
            <!--        --><? //= $form->field($model, 'formNumber')->textInput(['placeholder' => $model->getAttributeLabel('formNumber')]) ?>
            <!--        --><? //= $form->field($model, 'formSeries')->textInput(['placeholder' => $model->getAttributeLabel('formSeries')]) ?>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Поиск', ['class' => 'btn btn-primary']) ?>
            </div>

            <p class="text-danger">
                <?php
                if ($model->errors) {
                    $errors = [];
                    foreach ($model->errors as $error) {
                        $errors += $error;
                    }
                    echo implode('<br>', $errors);
                }
                ?>
            </p>

            <?php ActiveForm::end() ?>
        </div>
    </div>

<?php
if ($dataProvider) :

    echo GridView::widget([
        'layout' => "{items}\n{summary}\n{pager}",
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '30px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
                'attribute' => 'DateOfDiagnosis',
                'label' => 'Дата диагностики',
            ],
            [
                'attribute' => 'Operator.ShortName',
                'label' => 'Оператор',
            ],
            [
                'attribute' => 'Expert',
                'value' => function ($model) {
                    $name = ArrayHelper::getValue($model, 'Expert.Name');
                    $surname = ArrayHelper::getValue($model, 'Expert.FName');
                    $middlename = ArrayHelper::getValue($model, 'Expert.MName');
                    return "$name $surname $middlename";
                },
                'label' => 'Эксперт',
            ],
            [
                'attribute' => 'Form.Number',
                'label' => 'Номер в ЕАИСТО',
            ],
            [
                'attribute' => 'Form.Validity',
                'label' => 'Действует до',
            ],
            [
                'attribute' => 'Vehicle',
                'value' => function ($model) {
                    $make = ArrayHelper::getValue($model, 'Vehicle.Make');
                    $model = ArrayHelper::getValue($model, 'Vehicle.Model');
                    return "$make $model";
                },
                'label' => 'Модель ТС',
            ],
            [
                'attribute' => 'VehicleCategory',
                'label' => 'Категория',
            ],
            [
                'attribute' => 'Vin',
                'label' => 'VIN',
            ],
            [
                'attribute' => 'BodyNumber',
                'label' => 'Кузов',
            ],
            [
                'attribute' => 'FrameNumber',
                'label' => 'Шасси',
            ],

        ],
        'containerOptions' => ['style' => 'overflow: auto'],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true,
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-list-alt"></i> Результаты поиска',
            'type' => GridView::TYPE_PRIMARY,
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize' => true,
        'hover' => true,
        'responsive' => true,
    ]);

endif; ?>