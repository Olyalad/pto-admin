<?php

namespace app\models;

use app\modules\register\models\Card;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $nameg
 * @property string $sec
 * @property string $podr
 */
class Groups extends \yii\db\ActiveRecord
{
    public $user_array = [];        // Пользователи в группе

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameg', 'sec',], 'required'],
            [['nameg', 'sec', 'podr'], 'string'],
            [['podr'], 'default', 'value' => ''],

            [['user_array'], 'safe'], // Безопасные аттрибуты
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nameg' => 'Название группы',
            'sec' => 'Эксперт',
            'podr' => 'Podr',
        ];
    }

    public static function getList($from = 'nameg', $to = 'nameg')
    {
        $query = self::find();
        if (Yii::$app->user->can('zam')) {
            $query->andWhere(['nameg' => 'Zam']);
        }
        return ArrayHelper::map($query->all(), $from, $to);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['groups' => 'nameg']);
    }

    public function getSecUser()
    {
        return $this->hasOne(User::className(), ['login' => 'sec']);
    }

    /**
     * Заполнение массива пользователей в группе
     *
     * Выполняется, как правило, при инциализации модели
     */
    public function fill()
    {
        // Пользователи
        if ($this->users) {
            foreach ($this->users as $user) {
                $name = $user->first_name;
                $name .= " (" . $user->login . ")"; // добавляем ID к надписи
                $this->user_array[$user->id] = $name;
            }
        }
    }

    public function beforeSave($insert)
    {
        // Удаляем сначала прошлые связи с пользователями
        User::updateAll(['groups' => null], ['groups' => $this->nameg]);
//        $this->unlinkAll('users');
        // Сохраняем новые связи
        if ($this->user_array) {
            foreach ($this->user_array as $user) {

                $user = User::findOne($user);
                $user->groups = $this->nameg;
                $user->updateAttributes(['groups']);
            }
        }

        // устанавливам пользователю права Эксперта Группы
        if ($this->sec) {
            $user = User::findOne(['login' => $this->sec]);
            $user->groups = $this->nameg;
            $user->updateAttributes(['groups']);

            $auth = Yii::$app->authManager;

            if (!$auth->checkAccess($user->id, 'group_expert')) {
                $gr_expert = $auth->getRole('group_expert');
                $auth->assign($gr_expert, $user->id);
            }
        }

        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        User::updateAll(['groups' => null], ['groups' => $this->nameg]);
        Card::updateAll(['groupu' => null], ['groupu' => $this->nameg]);
        return parent::beforeDelete();
    }
}
