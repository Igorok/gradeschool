<?php

/**
 * Модель для таблицы "{{post_comments}}".
 *
 */
class PostComments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post_comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('post_id, user_id, description', 'required','message'=>'Вы не заполнили {attribute}'),
			array('post_id, user_id', 'numerical', 'integerOnly'=>true),
			array('create_time', 'safe')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => 'Пост',
			'user_id' => 'Пользователь',
			'description' => 'Ваш комментарий',
			'create_time' => 'Время создания',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PostComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	function clear_tags($str)
    {
        return strip_tags($str);
    }

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	
	protected function beforeSave()
	{
        $this->description = $this->clear_tags($this->description);
		$this->create_time = new CDbExpression('NOW()');
        return true;
	}
	
}
