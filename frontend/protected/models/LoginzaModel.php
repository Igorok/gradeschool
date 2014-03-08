<?php
class LoginzaModel extends CModel {
 
    public $identity;
    public $provider;
    public $email;
    public $fio;
    public $token;
    public $error_type;
    public $error_message;
 
    private $loginzaAuthUrl = 'http://loginza.ru/api/authinfo?token=';
 
    public function rules() {
        return array(
            array('identity,provider,token', 'required'),
            array('email', 'email'),
            array('identity,provider,email', 'length', 'max'=>255),
            array('fio', 'length', 'max'=>55),
        );
    }
 
    public function attributeLabels() {
        return array(
            'identity'=>'Идентификатор сервиса аутентификации',
            'provider'=>'Сервис аутентификации',
            'email'=>'eMail',
            'fio'=>'Имя',
        );
    }
 
    /**
     * Получение данных от сервиса Loginza.
     * Предварительно нужно установить $this->token
     * Например, так
     * $loginza = new LoginzaModel();
     * $loginza->setAttributes($_POST);
     */
    public function getAuthData() {
        //получаем данные от сервера Loginza
        $authData = json_decode(
                file_get_contents($this->loginzaAuthUrl.$this->token)
                ,true);
 
        //устанавливаем атрибуты
        //если будут отсутствовать identity и provider, метод validate
        //выдаст ошибку
        $this->setAttributes($authData);
        //fio находится внутри вложенного массива
        //TODO доделать установку имени для разных сервисов
        $this->fio = (isset($authData['name']['fio'])) ? $authData['name']['fio'] : $authData['identity'];
    }
 
    /**
     * Аутентификация посетителя.
     * @return boolean true - если посетитель аутентифицирован, false - в противном случае.
     */
    public function login() {
        $identity = new LoginzaUserIdentity();
        if ($identity->authenticate($this)) {
            $duration = 3600*24*30; // 30 days
            Yii::app()->user->login($identity,$duration);
            return true;
        }
        return false;
    }
 
    public function attributeNames() {
        return array(
            'identity'
            ,'provider'
            ,'email'
            ,'fio'
            ,'token'
            ,'error_type'
            ,'error_message'
        );
    }
}