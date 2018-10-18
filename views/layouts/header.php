<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use lowbase\user\models\User;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a(
        Html::img('/img/log.png') . ' ПТО54', ['/'],
        [
            'class' => 'logo',
            'style' => 'text-align: inherit; padding: 0;'
        ]) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if ($me->image) { ?>
                            <img src="/<?= $me->image ?>" class="user-image"/>
                        <?php } else { ?>
                            <span class="glyphicon glyphicon-user"></span>
                        <?php } ?>
                        <span class="hidden-xs"><?= $me->first_name ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <?php if ($me->image) { ?>
                                <img src="/<?= $me->image ?>" class="img-circle"/>
                            <?php } else {
                                if ($me->sex === User::SEX_FEMALE) {
                                    echo "<img src='" . $userAsset->baseUrl . "/image/female.png' class='img-circle'>";
                                } else {
                                    echo "<img src='" . $userAsset->baseUrl . "/image/male.png' class='img-circle'>";
                                }
                            } ?>
                            <p>
                                <?= $me->first_name . " " . $me->last_name ?>
                                <small><?= $me->email ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
