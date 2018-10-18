<?php

use app\modules\register\models\Card;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this \yii\web\View */
/** @var $model \app\modules\register\models\Card */

$this->title = 'Просмотр';
$this->params['breadcrumbs'][] = ['label' => 'Реестр', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-solid">
    <div class="box-body">
        <?= Html::a('Печать', ['print', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Печать со штампом', ['print-stamp', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?php
        if (Yii::$app->user->can('admin')) {
            echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ' ';
            echo Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']);
        }
        ?>

        <br>
        <br>
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-condensed table-bordered detail-view'],
            'attributes' => [
                'fio',
                'phone',
                'eista',
                'vin',
                'reg',
                'yvip',
                'mark',
                'ram',
                'kuz',
                'probeg',
                'mass',
                'rmass',
                [
                    'attribute' => 'kat',
                    'value' => "$model->kat $model->kat1",
                ],
                'shin',
                [
                    'attribute' => 'topl',
                    'value' => Card::$toplNames[$model->topl],
                ],
                [
                    'attribute' => 'torm',
                    'value' => Card::$tormNames[$model->torm],
                ],
                [
                    'attribute' => 'doc',
                    'value' => Card::$docNames[$model->doc],
                ],
                'sireal',
                'number',
                'kogda',
//                'inostr',
                'kem',
                'dated',
                'dateof',
                'user',
                'test',
                'ist',
//                'groupu',
                's',
//                'ip',
            ],
        ]) ?>
    </div>
</div>
