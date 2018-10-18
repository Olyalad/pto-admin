<?php

namespace app\modules\user\models;


use app\models\Groups;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class GroupsSearch extends Groups
{
    const COUNT = 50; // количество  на одной странице

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameg', 'sec', 'podr'], 'safe'],
        ];
    }


    /**
     * Сценарии
     * @return array
     */
    public function scenarios()
    {
        return Model::scenarios();
    }


    /**
     * Создает DataProvider на основе переданных данных
     * @param $params - параметры
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Groups::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this::COUNT,
            ],
        ]);

        $this->load($params);

        // Если валидация не пройдена, то ничего не выводить
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // Фильтр данных
        $query->andFilterWhere([
            'id' => $this->id,
        ]);


        $query->andFilterWhere(['like', 'nameg', $this->nameg])
            ->andFilterWhere(['like', 'sec', $this->sec]);


        return $dataProvider;
    }

}