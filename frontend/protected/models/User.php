<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property string $fio
 * @property string $about
 * @property string $dob
 * @property string $profession
 * @property string $image_name
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 */
class User extends CActiveRecord
{
	
	// Повторный пароль нужно объявить, т.к. этого поля нет в БД
    public $password_repeat;
	// капча
	public $verifyCode;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, password_repeat, email', 'required', 'on'=>'check_registration, check_update', 'message'=>'Введите значение {attribute}'),			
			array('email', 'email', 'on'=>'check_registration, check_update', 'message'=>'Введите корректный {attribute}'),
			array('username, password, email, fio', 'length', 'max'=>128, 'on'=>'check_registration, check_update', 'message'=>'Слишком длинное значение {attribute}'),
			array('profession, image_name', 'length', 'max'=>255, 'on'=>'check_registration, check_update', 'message'=>'Слишком длинное значение {attribute}'),
			array('profile, about, dob', 'safe'),
			 // Пароль должен совпадать с повторным паролем для сценария регистрации
            array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'check_registration, check_update', 'message'=>'Повторный пароль не совпадает'),
			// Почта должна быть уникальной
            array('email, username', 'unique', 'on'=>'check_registration, check_update', 'message'=>'Данный {attribute} уже зарегистрирован'),
            // Почта должна быть написана в нижнем регистре
            array('email', 'filter', 'filter'=>'mb_strtolower', 'on'=>'check_registration, check_update', 'message'=>'Значение {attribute} должно быть написана в нижнем регистре'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'on'=>'check_registration', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'Введите корректный код'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, profile, fio, about, dob, profession, image_name, user_status', 'safe', 'on'=>'search'),
		);
	}
	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'user_id'),
			'comments' => array(self::HAS_MANY, 'PostComments', 'user_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'user_status'),
		);
	}
	
	public function getUrl()
	{
		return Yii::app()->createUrl('user/view', array(
			'id'=>$this->id,
			'username'=>$this->username,
		));
	}
	
	
	public function validatePassword($password)
	{
		return crypt($password,$this->password)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password' => 'Пароль',
			'email' => 'Email',
			'profile' => 'Profile',
			'fio' => 'ФИО',
			'about' => 'О себе',
			'dob' => 'Дата рождения',
			'profession' => 'Профессия',
			'image_name' => 'Фотография',
			'verifyCode' => 'Код с картинки',
			'password_repeat' => 'Повторите пароль',
			'create_time' => 'Время создания',
		);
	}
	
	
	
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=md5($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(md5($rand),0,22),array('+'=>'.'));
		return $salt;
	}
	
    // old password
    protected function oldPassword($id){
        $oldModel = User::model()->findByPk($id);
        $oldPass = $oldModel->password;
        return $oldPass;
    }
    
	// заполнение полей перед сохранением
	public function beforeSave() {
        if($this->isNewRecord)
		{
            $this->create_time= new CDbExpression('NOW()');
		}
        
        $this->username = strip_tags($this->username);
		$this->fio = strip_tags($this->fio);
		$this->about = strip_tags($this->about);
		$this->profession = strip_tags($this->profession);
        
		if (!empty($this->password)){
            if($this->isNewRecord)
			{
				$this->password = $this->hashPassword($this->password);
			}
			else {
                 if($this->oldPassword($this->id) != $this->password){
                    $this->password = $this->hashPassword($this->password);
                }
            }
        }
        
		$this->user_status = 1;
		return true;
	}
	
    
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_thumb',$this->image_thumb,true);
		$criteria->compare('user_status',$this->user_status,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}