<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $full_description
 * @property string $image_name
 * @property string $link
 * @property string $create_time
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property VideoCategory $category
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, short_description, full_description, link, category_id, page_url', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('short_description, image_name', 'length', 'max'=>255),
			array('meta_description, meta_keywords', 'safe'),
            // проверка типа файла
			array('image_name', 'file', 
                'types' => 'gif, jpg, jpeg, png', 'message'=>'Выберите файл формата jgp, png, gif', 
                'maxSize'=>3000 * 3000 * 5, // 5MB
                'tooLarge'=>'Файл слишком большой, загрузите файлы меньших размеров', 'allowEmpty' => true),
                
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, short_description, page_url, category_id', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Videocategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название видео',
			'short_description' => 'Краткое описание',
			'full_description' => 'Описание видео',
			'image_name' => 'Картинка',
			'link' => 'Ссылка',
			'create_time' => 'Время создания',
			'category_id' => 'Категория',
			'page_url' => 'URL статьи',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('page_url',$this->page_url);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		$this->full_description = strip_tags($this->full_description);
        
		$this->create_time = new CDbExpression('NOW()');
		return true;
	}
}