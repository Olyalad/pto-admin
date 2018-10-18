<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'lowbase',
    'name' => 'lowBase',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'ISfNWi2OD58V6WoC8fYVx0q28RaiilRr',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //-----------------------
        // Компонент пользователя
        //-----------------------
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
            'on afterLogin' => function ($event) {
                lowbase\user\models\User::afterLogin($event->identity->id);
            }
        ],
        //---------------------------------------------
        // Для реализации разделения прав пользователей
        // с помощью коробочного модуля Yii2 RBAC.
        //---------------------------------------------
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'lb_auth_item',
            'itemChildTable' => 'lb_auth_item_child',
            'assignmentTable' => 'lb_auth_assignment',
            'ruleTable' => 'lb_auth_rule'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
//        'mailer' => require(__DIR__ . '/mailer.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'enableStrictParsing' => true,
            'rules' => [


//                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',

                //Стартовая страница сайта
                '<action:(login|logout)>' => 'site/<action>',
                '/' => 'site/index',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/lowbase',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'document' => 'document/messages/document.php',
                        'user' => 'document/messages/user.php'
                    ]
                ],
            ],
        ],

        'formatter' => [
            'locale' => 'ru-RU',

        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'document' => [
            'class' => 'app\modules\document\Module',
        ],
        'register' => [
            'class' => 'app\modules\register\Module',
        ],
        'search' => [
            'class' => 'app\modules\search\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
