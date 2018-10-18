<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="document-index">
    <?= Html::a('Квитанция', ['receipt'], ['class' => 'btn btn-primary']) ?>
</div>
