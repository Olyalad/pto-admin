<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

/* @var $this yii\web\View */
/* @var $model \app\models\Groups */

$this->title = Yii::t('user', 'Редактирование группы');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Права и группы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameg, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'Редактирование');

?>
<div class="auth-item-update">

    <div class="box box-solid">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>
