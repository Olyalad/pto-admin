<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use lowbase\user\UserAsset;

/* @var $this yii\web\View */
/* @var $model lowbase\user\models\AuthItem */

$this->title = Yii::t('user', 'Новая роль');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Права и группы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$assets = UserAsset::register($this);

?>
<div class="auth-item-create">

    <div class="box box-solid">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
