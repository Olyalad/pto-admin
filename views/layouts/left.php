<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => 'Пользователи',
                        'icon' => 'fa fa-user',
                        'url' => ['/user/user/index'],
                        'visible' => Yii::$app->user->can('admin')
                            || Yii::$app->user->can('group_expert'),
                    ],
                    [
                        'label' => 'Права и группы',
                        'icon' => 'fa fa-eye-slash',
                        'url' => ['/user/auth-item/index'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],

                    [
                        'label' => 'Документы',
                        'icon' => 'fa fa-file',
                        'url' => ['/document/document/index'],
                    ],

                    [
                        'label' => 'Реестр',
                        'icon' => 'fa fa-list',
                        'url' => ['/register/card/index'],
                    ],
                    [
                        'label' => 'Добавить',
                        'icon' => 'fa fa-plus',
                        'url' => ['/register/card/create'],
                    ],
                    [
                        'label' => 'Поиск',
                        'icon' => 'fa fa-search',
                        'url' => ['/search'],
                    ],


                ],
            ]
        ) ?>

    </section>

</aside>
