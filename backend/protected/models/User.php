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
			array('username, password, email, user_status', 'required', 'message'=>'Введите значение {attribute}'),			
			array('email', 'email', 'message'=>'Введите корректный {attribute}'),
			array('username, password, email, fio', 'length', 'max'=>128, 'message'=>'Слишком длинное значение {attribute}'),
			array('profession, image_name', 'length', 'max'=>255, 'message'=>'Слишком длинное значение {attribute}'),
			array('profile, about, dob', 'safe'),
			
			// Почта должна быть уникальной
            array('email, username', 'unique', 'message'=>'Данный {attribute} уже зарегистрирован'),
            // Почта должна быть написана в нижнем регистре
            array('email', 'filter', 'filter'=>'mb_strtolower', 'message'=>'Значение {attribute} должно быть написана в нижнем регистре'),			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, profile, fio, about, dob, profession, image_name, image_name, user_status', 'safe', 'on'=>'search'),
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
			'image_thumb' => 'Миниатюра',
			'verifyCode' => 'Код с картинки',
			'user_status' => 'Статус пользователя',
			'create_time' => 'Дата регистрации',
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
	
	// генерация даты
	public function dateGen($dob)
	{
		$month = substr($dob, 0, 2);
		$day = substr($dob, 3, 2);
		$year = substr($dob, 6, 4);
		//echo $month . $day . $year;exit;
		$dob = mktime( 0,0,0,$month,$day,$year);
		return $dob;
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
        // при обновлении пользователя, пароль сравнивается со старым и криптуется если новый не совпадает со старым
		if (!empty($this->password)){
            if($this->isNewRecord)
			{
				$this->password = $this->hashPassword($this->password);
			}
			else {
                //echo $this->oldPassword($this->id) . '<br />' . $this->hashPassword($this->password);exit;
                 if($this->oldPassword($this->id) != $this->password){
                    $this->password = $this->hashPassword($this->password);
                }
            }
        }
        
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