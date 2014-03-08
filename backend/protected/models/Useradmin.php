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

class Useradmin extends CActiveRecord
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
		return '{{user_admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required', 'message'=>'Введите значение {attribute}'),
			array('username, password, profile', 'length', 'max'=>128, 'message'=>'Слишком длинное значение {attribute}'),
            // уникальность
            array('username', 'unique', 'message'=>'Данный {attribute} уже зарегистрирован'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password', 'safe', 'on'=>'search'),
		);
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
			'profile' => 'Профиль',
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
        $oldModel = Useradmin::model()->findByPk($id);
        $oldPass = $oldModel->password;
        return $oldPass;
    }
    
    
	// заполнение полей перед сохранением
	public function beforeSave() {
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
		$criteria->compare('profile',$this->profile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}