<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ImageUpload extends CFormModel
{
	public $filename;
	public $file;
	public function rules()
	{
		return array(
			// filename are required
			array('filename', 'required'),
            // проверка типа файла
			array('filename', 'file', 
                'types' => 'gif, jpg, jpeg, png', 'message'=>'Выберите файл формата jgp, png, gif', 
                'maxSize'=>3000 * 3000 * 2, // 2MB
                'tooLarge'=>'Файл слишком большой, загрузите файлы меньших размеров', 'allowEmpty' => true),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'filename'=>'Выберите изображение',
		);
	}
}
