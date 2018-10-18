<?php

namespace app\modules\document\models;


/**
 * This is the model class for table "kvit".
 *
 * @property int $id
 * @property string $userk
 */
class Kvit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kvit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userk'], 'required'],
            [['userk'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userk' => 'Userk',
        ];
    }
}
