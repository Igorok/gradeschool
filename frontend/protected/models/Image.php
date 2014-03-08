<?php

/**
 * This is the model class for table "{{image}}".
 *
 * The followings are the available columns in table '{{image}}':
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
 * @property ImageCategory $category
 */
class Image extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Image the static model class
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
		return '{{image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, short_description, full_description, image_name, category_id', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('title, short_description, image_name', 'length', 'max'=>255),
			array('link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, short_description, full_description, image_name, link, create_time, category_id', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Imagecategory', 'category_id'),
		);
	}
	
	
	public function getUrl()
	{
		return Yii::app()->createUrl('image/view', array(
			'id'=>$this->id,
			'pageUrl'=>$this->page_url,
		));
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'short_description' => 'Краткое описание',
			'full_description' => 'Полное описание',
			'image_name' => 'Картинка',
			'link' => 'Ссылка на скачивание',
			'create_time' => 'Время создания',
			'category_id' => 'Категория',
			'page_url' => 'URL статьи',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
		);
	}

	
}