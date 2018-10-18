<?php

namespace app\modules\register\models;


use app\models\User;
use SoapClient;
use Yii;
use yii\base\Model;

class AddCardForm extends Model
{
    public $card_id;

    public $surname;
    public $firstname;
    public $middlename;
    public $phone;
    public $ist;

    public $vin;
    public $yvip;
    public $mark;
    public $model;
    public $kuz;
    public $ram;
    public $probeg;
    public $reg;

    public $mass;
    public $rmass;

    public $kat;
    public $kat1;

    public $shin;
    public $topl;
    public $torm;

    public $doc;
    public $sireal;
    public $number;
    public $kogda;
    public $kem;
    public $inostr;

    public $dated;
    public $dateof;

    public $test;

    public function rules()
    {
        return [
            [
                [
                    'surname', 'firstname', 'phone', 'ist',
                    'yvip', 'mark', 'model', 'probeg', 'mass', 'kat', 'kat1',
                    'shin', 'rmass', 'topl', 'torm',
                    'doc', 'sireal', 'number', 'kogda', 'kem', 'inostr',
                    'dated', 'dateof',],
                'required'
            ],

            // СТРОКИ
            [
                [
                    'surname', 'firstname', 'middlename', 'ist',
                    'mark', 'model', 'kuz', 'ram', 'reg',
                    'kat', 'kat1',
                    'shin', 'topl', 'torm',
                    'doc', 'sireal', 'number', 'kem', 'test', 'inostr',],
                'string', 'max' => 255
            ],
            [['kem'], 'string'],
            [['phone'], 'string', 'max' => 11],  // длина строки телефона 11 символов
            [['vin'], 'string', 'length' => 17], // длина строки vin 17 символов
            [['vin'], 'match', 'pattern' => '/^[a-hj-npr-z0-9]*$/i',
                'message' => 'Значение {attribute} должно содержать латинские буквы (кроме I, O, Q) и цифры'],
            [['sireal'], 'match', 'pattern' => '/[0-9а-я]$/i',
                'message' => 'Значение {attribute} должно содержать русские буквы и цифры'],


            // ЧИСЛА
            [['probeg', 'mass', 'rmass'], 'integer'],
            [['yvip'], 'integer', 'max' => date('Y')],  // максимальный год - текущий


            // ДАТЫ
            [['kogda', 'dated', 'dateof'], 'date', 'format' => 'yyyy-MM-dd'],


            // ФИЛЬТРЫ
            [
                [
                    'surname', 'firstname', 'middlename',
                    'vin', 'mark', 'model', 'kuz', 'ram', 'reg', 'kat', 'kat1', 'shin', 'kem',],
                'filter', 'filter' => 'mb_strtoupper'],  // делаем заглавные буквы
            [
                [
                    'surname', 'firstname', 'middlename',
                    'vin', 'mark', 'model', 'kuz', 'ram', 'reg', 'kat', 'kat1', 'shin', 'kem',],
                'trim'],  // обрезаем пробелы

            [['test'], 'default', 'value' => 'Passed'], // прошел диагностику или нет. 'Passed' - да

            // БЕЗОПАСНЫЕ АТТРИБУТЫ
            [['card_id'], 'safe'],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'surname' => 'Фамилия',
            'firstname' => 'Имя',
            'middlename' => 'Отчество',
            'phone' => 'Телефон (7XXXXXXXXXX)',
            'ist' => 'Источник',

            'vin' => 'VIN',
            'yvip' => 'Год выпуска',
            'mark' => 'Марка',
            'model' => 'Модель',
            'kuz' => 'Номер кузова',
            'ram' => 'Шасси (Рама) №',
            'probeg' => 'Пробег (км)',
            'reg' => 'Регистрационный знак',

            'mass' => 'Масса без нагрузки (кг)',
            'rmass' => 'Разрешенная макс. масса (кг)',
            'kat' => 'Категория ТС (СРТС или ПТС)',
            'kat1' => 'Категория ТС (ОКП)',
            'shin' => 'Марка шин',
            'topl' => 'Тип топлива',
            'torm' => 'Тип привода тормозной системы',

            'doc' => 'Регистрационный документ',
            'sireal' => 'Серия документа',
            'number' => 'Номер документа',
            'kogda' => 'Когда выдан документ',
            'inostr' => 'Собственник иностранный гражданин',
            'kem' => 'Кем выдан документ',

            'dated' => 'Дата диагностики',
            'dateof' => 'Срок действия',

            'test' => 'Прошел',

        ];
    }

    public function checkLimit()
    {
        $today = Yii::$app->formatter->asDate(time(), 'yyyy-MM-dd');
        $cardsLimit = Card::find()->where(['dated' => $today])->count();
        if ($cardsLimit >= Yii::$app->params['cols_limit']) {
            return 'ПРЕВЫШЕН ДНЕВНОЙ ЛИМИТ!';
        }

        $userLimit = Yii::$app->user->identity->size;
        if ($userLimit) {
            $cardsLimit = Card::find()
                ->where([
                    'dated' => $today,
                    'user' => Yii::$app->user->identity->login,
                ])
                ->count();
            if ($userLimit >= $cardsLimit) {
                return 'ВЫ ПРЕВЫСИЛИ СВОЙ ЛИМИТ ЗАПРОСОВ!';
            }
        }

        return true;
    }


    public function add()
    {
        $formatter = Yii::$app->formatter;
        $this->kogda = $formatter->asDate($this->kogda, 'yyyy-MM-dd');
        $this->dated = $formatter->asDate($this->dated, 'yyyy-MM-dd');
        $this->dateof = $formatter->asDate($this->dateof, 'yyyy-MM-dd');

        if (!$this->validate())
            return false;

        if ($this->card_id) {
            $card = Card::findOne($this->card_id);
        } else {
            $card = new Card();
        }

        $card->fio = implode(' ', [$this->surname, $this->firstname, $this->middlename]);
        $card->phone = $this->phone;
        $card->ist = $this->ist;

        $card->vin = $this->vin;
        $card->yvip = $this->yvip;

        $card->mark = "{$this->mark} {$this->model}";
        $card->kuz = $this->kuz;
        $card->ram = $this->ram;
        $card->probeg = $this->probeg;
        $card->reg = $this->reg;

        $card->mass = $this->mass;
        $card->rmass = $this->rmass;
        $card->kat = $this->kat;
        $card->kat1 = $this->kat1;
        $card->shin = $this->shin;
        $card->topl = $this->topl;
        $card->torm = $this->torm;

        $card->doc = $this->doc;
        $card->sireal = $this->sireal;
        $card->number = $this->number;
        $card->kogda = $this->kogda;
        $card->inostr = $this->inostr;
        $card->kem = $this->kem;

        $card->dated = $this->dated;
        $card->dateof = $this->dateof;

        $card->test = $this->test;

        /* обязательные поля в Card */

        /** @var User $user */
        $user = Yii::$app->user->identity;

        $card->groupu = $user->group ? $user->group->nameg : '';
        $card->user = $user->login;
        $ist = $this->ist;
        if ($ist == "ВСК" || $ist == "Югория" || $ist == "PPF" || $ist == "Пальчун" || $ist == "Сундукова" || $ist == "Тощевикова") {
            $card->s = '300';
        } else {
            $card->s = $user->s;
        }
        $card->ip = $_SERVER['REMOTE_ADDR'];


        if (!$card->validate()) {
            return false;
        }

        $card->save();
        $this->card_id = $card->id;

        $eista_number = $this->registerEaisto();
        if ($eista_number !== false) {
            $card->eista = $eista_number;
            $card->updateAttributes(['eista']);

            return true;
        }

        return false;
    }


    protected function registerEaisto()
    {
        $params_register = [
            'user' => Yii::$app->params['eaisto_gibdd']['expert_access'],
            'card' => [
                'DateOfDiagnosis' => $this->dated,
                'Name' => "$this->surname",
                'FName' => "$this->firstname",
                'MName' => "$this->middlename",
                'RegistrationNumber' => "$this->reg",
                'TestResult' => $this->test ? $this->test : "Passed",
                'TestType' => "Primary",
                'Vehicle' => [
                    'Make' => "$this->mark",
                    'Model' => "$this->model"
                ],
                'VehicleCategory' => "$this->kat",
                'VehicleCategory2' => "$this->kat1",
                'Vin' => "$this->vin",
                'BodyNumber' => "$this->kuz",
                'FrameNumber' => "$this->ram",
                'DateOfRetest' => "$this->dateof",
                'Year' => "$this->yvip",
                'EmptyMass' => "$this->mass",
                'MaxMass' => "$this->rmass",
                'Fuel' => "$this->topl",
                'BrakingSystem' => "$this->torm",
                'Tyres' => "$this->shin",
                'Killometrage' => "$this->probeg",
                'RegistrationDocument' => [
                    'DocumentType' => "$this->doc",
                    'Organization' => "$this->kem",
                    'Date' => "$this->kogda",
                    'Series' => "$this->sireal",
                    'Foreign' => $this->inostr ? "Y" : "N",
                    'Number' => "$this->number"],
                'Values' => [
                    'Code' => "1",
                    'TestResult' => "",
                ],
                'Form' => [
                    'Duplicate' => false,
                    'Validity' => $this->test == 'Passed' ? "$this->dateof" : '',
                ],
                'Operator' => Yii::$app->params['eaisto_gibdd']['expert_operator'],
                'Expert' => Yii::$app->params['eaisto_gibdd']['expert_fio'],
            ]
        ];

        try {
            $wsdlUrl = Yii::$app->params['eaisto_gibdd']['wsdl_url'];
            $client = new SoapClient($wsdlUrl, Yii::$app->params['eaisto_gibdd']['soap_options']);

            $request_register = $client->RegisterCard($params_register);

            if (!$request_register->Nomer) {
                Yii::$app->session->addFlash('error', 'Ошибка при работе с сервисом ЕАИСТО ГИБДД : Не удалось получить номер ЕАИСТО. Отправьте форму еще раз.');
                return false;
            }

            return $request_register->Nomer;
        } catch (\SoapFault $e) {
            Yii::$app->session->addFlash('error', 'Ошибка при работе с сервисом ЕАИСТО ГИБДД : ' . $e->getMessage());
            return false;
        }
    }

}
