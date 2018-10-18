<?php

namespace app\modules\search\models;


use SoapClient;
use Yii;
use yii\base\Model;

class SearchForm extends Model
{
    public $vin;
    public $reg;
    public $formNumber;
    public $formSeries;

    private $_result = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vin', 'reg'], 'required',
                'when' => function ($model) {
                    return !$model->reg && !$model->vin;
                },
                'message' => 'Одно из полей должно быть заполнено.'
            ],

            [['vin', 'reg', 'formNumber', 'formSeries'], 'default'],
            [['vin', 'reg', 'formNumber', 'formSeries'], 'trim'],

            [['reg', 'formNumber', 'formSeries'], 'string'],
            [['vin'], 'string', 'length' => 17], // длина строки vin 17 символов
            [['vin'], 'match', 'pattern' => '/^[a-hj-npr-z0-9]*$/i',
                'message' => 'Значение {attribute} должно содержать латинские буквы (кроме I, O, Q) и цифры'],

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vin' => 'VIN',
            'reg' => 'Рег. номер',
            'formNumber' => 'Номер Талона ТО',
            'formSeries' => 'Серия Талона ТО',
        ];
    }


    public function search()
    {
        if (!$this->validate())
            return false;

        try {

            $params = [
                "user" => Yii::$app->params['eaisto_gibdd']['expert_access'],
                "Purpose" => "ForDublicate",
                "vin" => "$this->vin",
                "regNumber" => "$this->reg",
            ];

            $wsdlUrl = Yii::$app->params['eaisto_gibdd']['wsdl_url'];
            $client = new SoapClient($wsdlUrl, Yii::$app->params['eaisto_gibdd']['soap_options']);

            $result = $client->GetCardByVin($params);

            $result = $result->GetCardByVinResult;

            if (!is_array($result)) {
                $result = [$result];
            }

            $this->_result = json_decode(json_encode($result), true);

        } catch (\SoapFault $e) {
            Yii::$app->session->addFlash('error', 'Ошибка при работе с сервисом ЕАИСТО ГИБДД : ' . $e->getMessage());
            return false;
        }

        return true;
    }


    public function getResult()
    {
        return $this->_result;
    }
}