<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */


$params = [
    'adminEmail' => 'lowbase@yandex.ru',
    //Action капчи в параметрах заполняется в случае если изменяются пути капчи
    //в конфигурации приложения и используются унаследованные модули или просто
    // модели и контроллеры от yii2-user.
    'captchaAction' => 'lowbase/user/captcha',

    'cols_limit' => 62,

    'eaisto_gibdd' => [

        'wsdl_url' =>
            'https://eaisto.gibdd.ru/common/ws/arm_expert.php?wsdl',

        'soap_options' => [
            'trace' => true,
            'exceptions' => true,
        ],

        'expert_access' => [
            'Name' => "andrianovAndrey",
            // 'Password' => "bwZvw8CCqsM4Rp45",
            'Password' => "Z0yoS7gooeuRJg4Q",
            'ExtSystem' => 'sys1'
        ],
        'expert_fio' => [
            'Name' => "Андриянов",
            'FName' => "Андрей",
            'MName' => "Анатольевич"
        ],
        'expert_operator' => [
            'ShortName' => "ПТО 54",
            'FullName' => "Пункт Технического Осмотра 54"
        ],

        'number_attempts' => 3,  // количество попыток при получении уникального номера карточки в системе ЕАИСТО

    ],


];

if (YII_ENV_PROD) {
    $params['soap_options'] = [
        'location' => 'https://eaisto.gibdd.ru/common/ws/arm_expert.php',
        'uri' => 'http://tempuri.org/',
        'trace' => true,
        'exceptions' => true,
        'connection_timeout' => 1000,
        'default_socket_timeout' => 1000,
        'user_agent' => 'PHP WS',
        'stream_context' => stream_context_create([
            'socket' => [
                'bindto' => '46.4.203.59:0'
            ],
        ]),
    ];
}

return $params;