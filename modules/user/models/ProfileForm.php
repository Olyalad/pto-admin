<?php
/**
 * Created by PhpStorm.
 * User: Olya
 * Date: 07.10.2018
 * Time: 22:42
 */

namespace app\modules\user\models;


use app\models\User;
use Yii;

class ProfileForm extends User
{
    const SCENARIO_CREATE = 'create';

    public $password;   // Новый пароль

    /**
     * Правила валдиации
     * @return array
     */
    public function rules()
    {
        return [
            [['login', 'first_name'], 'required'],   // Обязательно для заполнения
            [['password'], 'required', 'on' => self::SCENARIO_CREATE],   // Обязательно для заполнения
            [['password'], 'passwordValidate', 'skipOnEmpty' => false], // Валидация пароля методом модели

            ['email', 'email'], // Электронная почта
            [['password'], 'string', 'min' => 4],   // Пароль минимум 4 символа
            [['sex', 'country_id', 'city_id', 'status', 'size', 's'], 'integer'],    // Целочисленные значения
            [['birthday', 'login_at'], 'safe'], // Безопасные аттрибуты
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 100], // Строковые значения (максимум 100 символов)
            [['auth_key'], 'string', 'max' => 32],  // Строковое значение (максимум 32 символа)
            [['ip'], 'string', 'max' => 20],    // Строковое значение (максимум 20 симоволов)
            [['password_hash', 'password_reset_token', 'email_confirm_token', 'image', 'address'], 'string', 'max' => 255], // Строка (максимум 255 символов)
            ['status', 'in', 'range' => array_keys(self::getStatusArray())], // Статус должен быть из списка статусов
            ['sex', 'in', 'range' => array_keys(self::getSexArray())], // Пол должен быть из гендерного списка
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'filter', 'filter' => 'trim'],   // Обрезание строк по краям
            [['last_name', 'password_reset_token', 'email_confirm_token',
                'image', 'sex', 'phone', 'country_id', 'city_id', 'address',
                'auth_key', 'password_hash', 'email', 'ip', 'login_at', 'size', 's', 'groups'], 'default', 'value' => null],   // По умолчанию = null
        ];
    }

    /**
     * Наименования дополнительных
     * полей формы
     * @return array
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['password'] = Yii::t('user', 'Новый пароль');
        return $labels;
    }

    /**
     * Генерация пароля и ключа авторизации,
     * преобразование дня рождения в необходимый
     * формат перед сохранением
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Если указан новый пароль
            if ($this->password) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * Валидация пароля
     *
     * Указывается обязательно при отсутствии
     * ключей авторизации соц. сетей
     */
    public function passwordValidate()
    {
        if ($this->password_hash === null && !$this->password) {
            $this->addError('password', Yii::t('user', 'Необходимо указать пароль.'));
        }
    }

}