<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $full_description
 * @property string $image_name
 * @property string $create_time
 * @property integer $user_id
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property PostCategory $category
 * @property User $user
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, short_description, full_description, category_id', 'required', 'message'=>'Поле {attribute} должно быть заполнено'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('title, short_description, image_name', 'length', 'max'=>255, 'message'=>'Слишком длинное значение для поля {attribute}'),
			// проверка типа файла
			array('image_name', 'file', 
                'types' => 'gif, jpg, jpeg, png', 'message'=>'Выберите файл формата jgp, png, gif', 
                'maxSize'=>3000 * 3000 * 2, // 2MB
                'tooLarge'=>'Файл слишком большой, загрузите файлы меньших размеров', 'allowEmpty' => true),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, short_description, full_description, image_name, create_time, user_id, category_id, status_id', 'safe', 'on'=>'search'),
		);
	}
	
	
	public function getUrl()
	{
		return Yii::app()->createUrl('post/view', array(
			'id'=>$this->id,
			//'title'=>$this->title,
		));
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => array(self::BELONGS_TO, 'Postcategory', 'category_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'likes' => array(self::HAS_MANY, 'PostLike', 'post_id'),
			'dislikes' => array(self::HAS_MANY, 'PostDislike', 'post_id'),
			'comments' => array(self::HAS_MANY, 'PostComments', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'short_description' => 'Краткое содержание Вашего поста',
			'full_description' => 'Ваш пост',
			'image_name' => 'Загрузите фото или изображение',
			'create_time' => 'Время создания',
			'user_id' => 'id автора',
			'category_id' => 'Выберите категорию к которой относится Ваш пост',
			'status_id' => 'Статус статьи',
		);
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('full_description',$this->full_description,true);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
        $this->full_description=$this->clear_tags($this->full_description);
        $this->short_description=$this->clear_tags($this->short_description);
        $this->title=$this->clear_tags($this->title);
		$this->create_time = new CDbExpression('NOW()');
		$this->user_id=Yii::app()->user->id;
        $this->status_id=3;
        return true;
	}
	
	
	
	
}