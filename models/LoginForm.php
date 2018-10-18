<?php
/**
 * Created by PhpStorm.
 * User: Olya
 * Date: 07.10.2018
 * Time: 11:57
 */

namespace app\models;


use Yii;

class LoginForm extends \lowbase\user\models\forms\LoginForm
{
    public $login;              // Логин

    private $_user = false;

    /**
     * Правила валидации
     * @return array
     */
    public function rules()
    {
        return [
            // И Email и пароль должны быть заполнены
            [['login', 'password'], 'required'],
            // Булево значение (галочка)
            ['rememberMe', 'boolean'],
            // Валидация пароля из метода "validatePassword"
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Наименование полей формы
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('user', 'Пароль'),
            'login' => 'Логин',
            'rememberMe' => Yii::t('user', 'Запомнить меня'),
        ];
    }

    /**
     * Проверка комбинации Email - Пароль
     * @param $attribute
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {

            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('user', 'Неправильная введен Логин или Пароль.'));
            } elseif ($user && $user->status == User::STATUS_WAIT) {
                $this->addError('login', Yii::t('user', 'Аккаунт не подтвержден. Проверьте Email.'));
            } elseif ($user && $user->status == User::STATUS_BLOCKED) {
                $this->addError('login', Yii::t('user', 'Аккаунт заблокирован. Свяжитель с администратором.'));
            } elseif ($user && $user->status == User::STATUS_DELETED) {
                $this->addError('login', Yii::t('user', 'Аккаунт удален. Свяжитель с администратором.'));
            }
        }
    }

    /**
     * Получение модели пользователя
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(['login' => $this->login]);
        }

        return $this->_user;
    }

}