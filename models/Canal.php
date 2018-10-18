<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "canal".
 *
 * @property int $id
 * @property string $namek
 * @property string $sk
 * @property string $seck
 */
class Canal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'canal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namek', 'sk', 'seck'], 'required'],
            [['namek', 'sk', 'seck'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namek' => 'Namek',
            'sk' => 'Sk',
            'seck' => 'Seck',
        ];
    }

    public static function getList($from = 'namek', $to = 'namek')
    {
        $return = ArrayHelper::map(self::find()->all(), $from, $to);
        return $return;
    }
}
