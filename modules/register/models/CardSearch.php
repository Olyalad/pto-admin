<?php

namespace app\modules\register\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CardSearch represents the model behind the search form of `app\models\Card`.
 */
class CardSearch extends Card
{
    public $dated_start;
    public $dated_finish;

    public $dateof_start;
    public $dateof_finish;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 's'], 'integer'],
            [['dated_start', 'dated_finish', 'dateof_start', 'dateof_finish', 'vin', 'yvip', 'mark', 'ram', 'kuz', 'probeg', 'reg', 'mass', 'kat', 'kat1', 'shin', 'rmass', 'topl', 'torm', 'doc', 'sireal', 'number', 'kogda', 'inostr', 'kem', 'dated', 'dateof', 'user', 'fio', 'eista', 'test', 'size', 'ist', 'phone', 'groupu', 'ip'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Card::find();

        // add conditions that should always apply here
        $query->andWhere(['!=', 'eista', '']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!Yii::$app->user->can('admin')) {
            $this->user = Yii::$app->user->identity->login;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            's' => $this->s,
        ]);

        $query->andFilterWhere(['like', 'vin', $this->vin])
            ->andFilterWhere(['like', 'yvip', $this->yvip])
            ->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'ram', $this->ram])
            ->andFilterWhere(['like', 'kuz', $this->kuz])
            ->andFilterWhere(['like', 'probeg', $this->probeg])
            ->andFilterWhere(['like', 'reg', $this->reg])
            ->andFilterWhere(['like', 'mass', $this->mass])
            ->andFilterWhere(['like', 'kat', $this->kat])
            ->andFilterWhere(['like', 'kat1', $this->kat1])
            ->andFilterWhere(['like', 'shin', $this->shin])
            ->andFilterWhere(['like', 'rmass', $this->rmass])
            ->andFilterWhere(['like', 'topl', $this->topl])
            ->andFilterWhere(['like', 'torm', $this->torm])
            ->andFilterWhere(['like', 'doc', $this->doc])
            ->andFilterWhere(['like', 'sireal', $this->sireal])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'kogda', $this->kogda])
            ->andFilterWhere(['like', 'inostr', $this->inostr])
            ->andFilterWhere(['like', 'kem', $this->kem])
//            ->andFilterWhere(['like', 'dated', $this->dated])
//            ->andFilterWhere(['like', 'dateof', $this->dateof])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'eista', $this->eista])
            ->andFilterWhere(['like', 'test', $this->test])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'ist', $this->ist])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'groupu', $this->groupu])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        $query
            ->andFilterWhere(['>=', 'dated', $this->dated_start])
            ->andFilterWhere(['<=', 'dated', $this->dated_finish]);

        $query
            ->andFilterWhere(['>=', 'dateof', $this->dateof_start])
            ->andFilterWhere(['<=', 'dateof', $this->dateof_finish]);


        return $dataProvider;
    }
}
