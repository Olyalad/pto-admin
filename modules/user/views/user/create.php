<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\ProfileForm */
/* @var $disabled_group bool */


$this->title = 'Добавление пользователя';
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
div.required label:after {
    content: ' *';
    color: red;
}
");

?>
<div class="user-create">

    <div class="box box-solid">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
                'disabled_group' => $disabled_group,
            ]) ?>

        </div>
    </div>


</div>
