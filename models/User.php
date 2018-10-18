<?php
/**
 * @package   yii2-cms
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

namespace app\models;

use app\modules\register\models\Card;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Пользователи
 * Class Document
 * @package app\models
 *
 * @property int $id
 * @property string $login [varchar(255)]
 * @property int $size [int(11)]  Лимит
 * @property string $groups [varchar(255)]  Группа
 * @property int $s [int(11)]
 */
class User extends \lowbase\user\models\User
{
    const SCENARIO_SYNC = 'sync';

    const STATUS_DELETED = 4;      // ожидает подтверждения

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['id'], 'safe', 'on' => self::SCENARIO_SYNC],
            [['login'], 'required'],
            [['size', 's'], 'integer'],
            [['groups'], 'string']
        ]);
    }

    public function getGroup()
    {
        return $this->hasOne(Groups::class, ['nameg' => 'groups']);
    }

    public function delete()
    {
        $this->status = self::STATUS_DELETED;
        return $this->updateAttributes(['status']);
    }

    /**
     * Наименования полей модели
     * @return array
     */
    public function attributeLabels()
    {
        return parent::attributeLabels() + [
                'login' => 'Логин',
                'size' => 'Количество карт в день',
                'groups' => 'Группа',
                's' => 'Стоимость',
                'cardsToday' => 'Количество карт сегодня',
            ];
    }

    public static function getListUsers($from = 'login', $to = 'login')
    {
        return ArrayHelper::map(
            self::find()
                ->orderBy([$to => SORT_ASC])
                ->all(),
            $from, $to);
    }

    public function getCardsToday()
    {
        $today = Yii::$app->formatter->asDate(time(), 'yyyy-MM-dd');
        return Card::find()
            ->where([
                'dated' => $today,
                'user' => $this->login,
            ])
            ->count();
    }

    /**
     * Список всех пользователей
     * @param bool $show_id - показывать ID пользователя
     * @return array - [id => Имя Фамилия (ID)]
     */
    public static function getAll($show_id = false)
    {
        $users = [];
        $model = self::find()->all();
        if ($model) {
            foreach ($model as $m) {

                $name = $m->login;
                $name .= " (" . $m->first_name . " " . $m->last_name . ")";

                $users[$m->id] = $name;
            }
        }

        return $users;
    }
}
