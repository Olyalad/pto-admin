<?php

namespace app\modules\register\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property string $vin
 * @property string $yvip
 * @property string $mark
 * @property string $ram
 * @property string $kuz
 * @property string $probeg
 * @property string $reg
 * @property string $mass
 * @property string $kat
 * @property string $kat1
 * @property string $shin
 * @property string $rmass
 * @property string $topl
 * @property string $torm
 * @property string $doc
 * @property string $sireal
 * @property string $number
 * @property string $kogda
 * @property string $inostr
 * @property string $kem
 * @property string $dated
 * @property string $dateof
 * @property string $user
 * @property string $fio
 * @property string $eista
 * @property string $test
 * @property string $size
 * @property string $ist
 * @property string $phone
 * @property string $groupu
 * @property int $s
 * @property string $ip
 */
class Card extends \yii\db\ActiveRecord
{
    public static $docNames = [
        'RegTalon' => 'Свидетельство о регистрации транспортного средства',
        'PTS' => 'Паспорт транспортного средства',
    ];

    public static $toplNames = [
        'Petrol' => 'Бензин',
        'Diesel' => 'Дизельное топливо',
        'PressureGas' => 'Сжатый газ',
        'LiquefiedGas' => 'Сжиженный газ',
        'None' => 'Без топлива',
    ];

    public static $tormNames = [
        'Hydraulic' => 'Гидравлический',
        'Mechanical' => 'Механический',
        'Pneumatic' => 'Пневматический',
        'Combined' => 'Комбинированный',
        'None' => 'Без тормозной системы',
    ];

    public static $testNames = [
        'Passed' => 'Да',
        'NotPassed' => 'Нет'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ist', 's', 'ip'], 'required'],

            [['vin', 'yvip', 'mark', 'ram', 'kuz', 'probeg', 'reg', 'mass', 'kat', 'kat1', 'shin', 'rmass', 'topl', 'torm', 'doc', 'sireal', 'number', 'kogda', 'inostr', 'kem', 'dated', 'dateof', 'user', 'fio', 'eista', 'test', 'size', 'ist', 'phone', 'ip'], 'string'],

            [['s'], 'integer'],

            [['groupu'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vin' => 'VIN',
            'yvip' => 'Год выпуска',
            'mark' => 'Марка, Модель',
            'ram' => 'Номер шасси, рамы',
            'kuz' => 'Номер кузова',
            'probeg' => 'Пробег (км)',
            'reg' => 'Регистрационный знак',
            'mass' => 'Масса без нагрузки (кг)',
            'rmass' => 'Разрешенная максимальная масса (кг)',
            'kat' => 'Категория ТС',
            'kat1' => 'Категория ТС',
            'shin' => 'Марка шин',
            'topl' => 'Тип топлива',
            'torm' => 'Тип тормозной системы',
            'doc' => 'Документ',
            'sireal' => 'Серия документа',
            'number' => 'Номер документ',
            'kogda' => 'Когда выдан документ',
            'inostr' => 'Собственник иностранный гражданин',
            'kem' => 'Кем выдан документ',
            'dated' => 'Дата выдачи',
            'dateof' => 'Срок действия',
            'user' => 'Пользователь',
            'fio' => 'ФИО',
            'eista' => 'Номер ЕАИСТО',
            'test' => 'Заключение о возможности/невозможности эксплуатации транспортного средства',
            'size' => 'Size',
            'ist' => 'Источник',
            'phone' => 'Телефон',
            'groupu' => 'Groupu',
            's' => 'Стоимость',
            'ip' => 'Ip',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert))
            return false;

        if ($insert) {
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->user = Yii::$app->user->identity->login;
        }

        return true;
    }

    public function getDocName()
    {
        return self::$docNames[$this->doc];
    }

    public function getToplName()
    {
        return self::$toplNames[$this->topl];
    }

    public function getTormName()
    {
        return self::$tormNames[$this->torm];
    }
}
